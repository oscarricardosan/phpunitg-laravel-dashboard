<?php

namespace App\Repositories\General;


use App\Entities\General\AppEntity;
use App\Entities\General\TagEntity;
use App\Interfaces\Repositories\General\TagRepositoryInterface;
use App\Repositories\BaseRepository;

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
}