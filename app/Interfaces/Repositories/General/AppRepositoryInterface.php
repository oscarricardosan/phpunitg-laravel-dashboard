<?php

namespace App\Interfaces\Repositories\General;


use App\Entities\General\AppEntity;
use App\Interfaces\Repositories\BaseRepositoryInterface;
use App\Maps\General\StoreAppMap;
use App\User;

interface AppRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * @return $this
     */
    public function store(StoreAppMap $storeMap);

    /**
     * @return $this
     */
    public function cleanAppTables();

    /**
     * @return $this
     */
    public function storeTestsOfExternalApp();

}