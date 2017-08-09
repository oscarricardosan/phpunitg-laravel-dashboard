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

    public function test()
    {
        return $this->belongsTo(TestEntity::class, 'test_id');
    }

    public function execution()
    {
        return $this->hasOne(Method_executionEntity::class, 'method_id');
    }

    public function executions()
    {
        return $this->hasMany(Method_executionEntity::class, 'method_id');
    }

}
