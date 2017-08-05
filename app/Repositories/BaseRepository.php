<?php

namespace App\Repositories;


use App\Entities\BaseEntity;
use App\Exceptions\RepositoryBaseException;
use App\Interfaces\Repositories\BaseRepositoryInterface;
use App\Maps\BaseMapper;
use App\User;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

abstract class BaseRepository implements BaseRepositoryInterface
{

    protected $entity;
    protected $user = null;
    protected $query = null;

    abstract public function getNewEntity();

    public function __construct($entity = null)
    {
        $this->setEntity($entity);
    }

    /**
     * @return $this
     */
    public function findOrFail($id){
        $entity = $this->newQuery()->findOrFail($id);
        $this->setEntity($entity);
        return $this;
    }

    /**
     * @return $this
     */
    public function find($id){
        $entity = $this->newQuery()->find($id);
        $this->setEntity($entity);
        return $this;
    }

    public function findAndGet($id){
        $entity = $this->newQuery()->find($id);
        $this->setEntity($entity);
        return $this->getEntity();
    }

    /**
     * @return BaseEntity|Collection
     */
    public function getEntity(){
        return $this->entity;
    }

    /**
     * @return $this
     */
    public function setEntity($entity){
        $this->entity = $entity;
        return $this;
    }

    public function getAll()
    {
        return $this->getNewEntity()->all();
    }

    /**
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return $this
     */
    public function commitCreate()
    {
        $this->validateUserIsPresent();
        try{
            $this->getEntity()->user_who_created_id = $this->user->id;
            $this->getEntity()->save();
            return $this;
        }catch (\Exception $e){
            throw new RepositoryBaseException('Exception to commitCreate', 0, $e);
        }
    }

    /**
     * @return $this
     */
    public function commitUpdate()
    {
        $this->validateUserIsPresent();
        try{
            $this->getEntity()->user_who_updated_id = $this->user->id;
            $this->getEntity()->save();
            return $this;
        }catch (\Exception $e){
            throw new RepositoryBaseException('Exception to commitUpdate', 0, $e);
        }
    }

    /**
     * @return $this
     */
    public function commitDelete()
    {
        $this->validateUserIsPresent();
        try{
            $this->getEntity()->user_who_deleted_id = $this->user->id;
            $this->getEntity()->save();
            $this->getEntity()->delete();
            return $this;
        }catch (\Exception $e){
            throw new RepositoryBaseException('Exception to commitDelete', 0, $e);
        }
    }

    protected function validateUserIsPresent()
    {
        if($this->user === null)
            throw new RepositoryBaseException('User is not setted.');
    }

    /**
     * @return QueryBuilder
     */
    protected function newQuery()
    {
        return $this->getNewEntity()->newQuery();
    }

    /**
     * @return $this
     */
    protected function setNewEntity(){
        $this->entity = $this->getNewEntity();
        return $this;
    }

    /**
     * @return $this
     */
    public function firstOrCreateRaw(array $data)
    {
        $this->entity =  $this->newQuery()->firstOrCreate($data);
        return $this;
    }

    /**
     * @return $this
     */
    public function firstOrNewRaw(array $data)
    {
        $this->entity =  $this->newQuery()->firstOrNew($data);
        return $this;
    }

    /**
     * @return $this
     */
    public function first()
    {
        $this->entity = $this->newQuery()->first();
        return $this;
    }

    /**
     * @return $this
     */
    public function fillFromMap(BaseMapper $mapper)
    {
        foreach ($mapper->getAttributes() as $attribute => $value){
            $this->getEntity()->{$attribute} = $value;
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function where($column, $value)
    {
        $this->entity = $this->query()->where($column, $value)->get();
        return $this;
    }


    /**
     * @return Paginator
     */
    public function paginate($recordsByPage = 20, $orderBy = 'created_at', $order = 'desc')
    {
        return $this->query()
            ->orderBy($orderBy, $order)
            ->paginate($recordsByPage);
    }

    /**
     * @return $this
     */
    public function clearQuery()
    {
        $this->query = null;
        return $this;
    }

    /**
     * @return QueryBuilder
     */
    public function query()
    {
        if(is_null($this->query))
            $this->query = $this->newQuery();

        return $this->query;
    }

    /**
     * @return Collection
     */
    public function getQuery()
    {
        $this->setEntity($this->query()->get());
        return $this->getEntity();
    }

    /**
     * @return $this
     */
    public function dataOfUserWhoCreated()
    {
        $this->query()->where('user_who_created_id', $this->user->id);
        return $this;
    }

    /**
     * integer
     */
    public function count()
    {
        return $this->query()->count();
    }

    /**
     * @param string $relationship_name
     * @return $this
     */
    public function deleteRecordsOfRelationship($relationship_name)
    {
        $this->validateUserIsPresent();
        try{
            if(!is_null($this->getEntity()->{$relationship_name})){
                $this->getEntity()->{$relationship_name}()->update([
                    'user_who_deleted_id' => $this->user->id
                ]);
                $this->getEntity()->{$relationship_name}()->delete();
            }
            return $this;
        }catch (\Exception $e){
            throw new RepositoryBaseException('Exception to commitDelete', 0, $e);
        }

    }
}