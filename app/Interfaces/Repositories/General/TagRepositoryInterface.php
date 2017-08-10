<?php

namespace App\Interfaces\Repositories\General;


use App\Entities\General\AppEntity;
use App\Interfaces\Repositories\BaseRepositoryInterface;

interface TagRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param AppEntity $appEntity
     * @return $this
     */
    public function setAppEntity(AppEntity $appEntity);

    /**
     * @param string $name
     * @return $this
     */
    public function store($name);

    /**
     * @return integer
     */
    public function countSuccessfulMethods();

    /**
     * @return integer
     */
    public function countFailedMethods();

    /**
     * @return integer
     */
    public function countMethodsWithoutExecution();
}