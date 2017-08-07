<?php

namespace App\Entities\General;


use App\Entities\BaseEntity;
use App\Interfaces\Repositories\General\TagRepositoryInterface;
use Illuminate\Support\Facades\App;

class TagEntity extends BaseEntity
{
    protected $table = 'tags';

    /**
     * @return TagRepositoryInterface
     */
    public function getRepo()
    {
        $repo= App::make(TagRepositoryInterface::class);
        return $repo->setEntity($this);
    }

    public function tests()
    {
        return $this->hasMany(TestEntity::class, 'tag_id');
    }

}
