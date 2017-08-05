<?php

namespace App\Repositories\General;


use App\Entities\General\AppEntity;
use App\Interfaces\Repositories\General\AppRepositoryInterface;
use App\Maps\General\StoreAppMap;
use App\Repositories\BaseRepository;

class AppRepository extends BaseRepository implements AppRepositoryInterface
{

    /**
     * @return AppEntity
     */
    public function getNewEntity()
    {
        return new AppEntity();
    }

    /**
     * @return $this
     */
    public function store(StoreAppMap $storeMap)
    {
        $this->setNewEntity();
        $this->fillFromMap($storeMap);
        $this->getEntity()->token= str_random(10);
        $this->getEntity()->save();
        return $this;
    }
}