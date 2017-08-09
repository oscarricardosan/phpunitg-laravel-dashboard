<?php

namespace App\Interfaces\Repositories\General;


use App\Entities\General\AppEntity;
use App\Entities\General\TestEntity;
use App\Interfaces\Repositories\BaseRepositoryInterface;
use App\Maps\General\ResponseExternalPhpunitResponse;

interface MethodRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param TestEntity $testEntity
     * @return $this
     */
    public function setTestEntity(TestEntity $testEntity);

    /**
     * @param string $name
     * @return $this
     */
    public function store($name);

    /**
     * @return ResponseExternalPhpunitResponse
     */
    public function runInPhpunit();
}