<?php

namespace App\Repositories\General;


use App\Entities\General\AppEntity;
use App\Entities\General\Method_executionEntity;
use App\Entities\General\MethodEntity;
use App\Entities\General\TagEntity;
use App\Interfaces\Repositories\General\TagRepositoryInterface;
use App\Repositories\BaseRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Support\Facades\DB;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{

    /**
     * @var AppEntity
     */
    protected $appEntity;

    /**
     * @return TagEntity
     */
    public function getNewEntity()
    {
        return new TagEntity();
    }

    /**
     * @param AppEntity $appEntity
     * @return $this
     */
    public function setAppEntity(AppEntity $appEntity)
    {
        $this->appEntity= $appEntity;
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function store($name)
    {
        $this->setNewEntity();
        $this->getEntity()->name= $name;
        $this->getEntity()->app_id= $this->appEntity->id;
        $this->getEntity()->save();
        return $this;
    }

    /**
     * @return integer
     */
    public function countSuccessfulMethods()
    {
        return $this->filterByExecutionState(true)->count();
    }

    /**
     * @return integer
     */
    public function countFailedMethods()
    {
        return $this->filterByExecutionState(false)->count();
    }

    /**
     * @return integer
     */
    public function countMethodsWithoutExecution()
    {
        return $this->filterByExecutionState(null)->count();

    }

    /**
     * @param string $stateExecution
     * @return QueryBuilder
     */
    protected function filterByExecutionState($stateExecution)
    {
        return DB::table('tests')
            ->leftJoin('methods', 'tests.id', '=', 'methods.test_id')
            ->leftJoin('method_executions', function ($join) {
                $join->on('methods.id', '=', 'method_executions.method_id')->whereNull('deleted_at');
            })
            ->where('tests.tag_id', $this->getEntity()->id)
            ->where('method_executions.success', $stateExecution);
    }
}