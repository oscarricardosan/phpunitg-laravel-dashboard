<?php

namespace App\Entities\General;


use App\Entities\BaseEntity;
use App\Interfaces\Repositories\General\MethodRepositoryInterface;
use Illuminate\Support\Facades\App;

class MethodEntity extends BaseEntity
{
    protected $table = 'methods';

    /**
     * @return MethodRepositoryInterface
     */
    public function getRepo()
    {
        $repo= App::make(MethodRepositoryInterface::class);
        return $repo->setEntity($this);
    }

}
