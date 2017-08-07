<?php

namespace App\Repositories\General;


use App\Entities\General\MethodEntity;
use App\Entities\General\TestEntity;
use App\Interfaces\Repositories\General\MethodRepositoryInterface;
use App\Repositories\BaseRepository;

class MethodRepository extends BaseRepository implements MethodRepositoryInterface
{
    /**
     * @var TestEntity
     */
    protected $testEntity;

    /**
     * @return MethodEntity
     */
    public function getNewEntity()
    {
        return new MethodEntity();
    }

    /**
     * @param TestEntity $testEntity
     * @return $this
     */
    public function setTestEntity(TestEntity $testEntity)
    {
        $this->testEntity= $testEntity;
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function store($name)
    {
        $this->setNewEntity();
        $this->getEntity()->test_id= $this->testEntity->id;
        $this->getEntity()->name= $name;
        $this->getEntity()->save();
        return $this;
    }
}