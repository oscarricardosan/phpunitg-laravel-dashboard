<?php

namespace App\Interfaces\Repositories\General;


use App\Entities\General\TagEntity;
use App\Interfaces\Repositories\BaseRepositoryInterface;

interface TestRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param TagEntity $tagEntity
     * @return $this
     */
    public function setTagEntity(TagEntity $tagEntity);

    /**
     * @param string $class
     * @param string $path
     * @return $this
     */
    public function store($class, $path);
}