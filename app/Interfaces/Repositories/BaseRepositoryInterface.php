<?php

namespace App\Interfaces\Repositories;

use App\Entities\BaseEntity;
use App\Maps\BaseMapper;
use App\User;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Oscarricardosan\Mapper\Mapper;

interface BaseRepositoryInterface
{
    public function getEntity();

    /**
     * @return $this
     */
    public function setEntity($entity);

    /**
     * @return $this
     */
    public function setUser(User $user);


    /**
     * @return integer
     */
    public function count();

    /**
     * @return $this
     */
    public function find($id);

    public function findAndGet($id);

    /**
     * @return $this
     */
    public function findOrFail($id);

    /**
     * @return $this
     */
    public function fillFromMap(BaseMapper $mapper);

    /**
     * @return $this
     */
    public function first();

    /**
     * @return $this
     */
    public function firstOrCreateRaw(array $data);

    /**
     * @return $this
     */
    public function firstOrNewRaw(array $data);

    public function getAll();

    /**
     * @return $this
     */
    public function commitCreate();

    /**
     * @return $this
     */
    public function commitUpdate();

    /**
     * @return $this
     */
    public function commitDelete();

    /**
     * @return Paginator
     */
    public function paginate($pages = 20);

    /**
     * @return $this
     */
    public function where($column, $value);

    /**
     * @return QueryBuilder
     */
    public function query();

    /**
     * @return Collection
     */
    public function getQuery();

    /**
     * @return $this
     */
    public function clearQuery();

    /**
     * @return $this
     */
    public function dataOfUserWhoCreated();

    /**
     * @param string $relationship_name
     * @return $this
     */
    public function deleteRecordsOfRelationship($relationship_name);


}