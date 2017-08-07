<?php

namespace App\Repositories\General;


use App\Entities\General\TagEntity;
use App\Entities\General\TestEntity;
use App\Interfaces\Repositories\General\TestRepositoryInterface;
use App\Repositories\BaseRepository;

class TestRepository extends BaseRepository implements TestRepositoryInterface
{

    /**
     * @var TagEntity
     */
    protected $tagEntity;

    /**
     * @return TestEntity
     */
    public function getNewEntity()
    {
        return new TestEntity();
    }

    /**
     * @param TagEntity $tagEntity
     * @return $this
     */
    public function setTagEntity(TagEntity $tagEntity)
    {
        $this->tagEntity= $tagEntity;
        return $this;
    }

    /**
     * @param string $class
     * @param string $path
     * @return $this
     */
    public function store($class, $path)
    {
        $this->setNewEntity();
        $this->getEntity()->tag_id= $this->tagEntity->id;
        $this->getEntity()->class= $class;
        $this->getEntity()->path= $path;
        $this->getEntity()->save();
        return $this;
    }
}