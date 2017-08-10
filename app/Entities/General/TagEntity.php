<?php

namespace App\Entities\General;


use App\Entities\BaseEntity;
use App\Interfaces\Repositories\General\TagRepositoryInterface;
use Illuminate\Support\Facades\App;

class TagEntity extends BaseEntity
{
    protected $table = 'tags';

    /**
     * @var TagRepositoryInterface
     */
    protected $repo;

    /**
     * @return TagRepositoryInterface
     */
    public function getRepo()
    {
        if(is_null($this->repo)){
            $this->repo= App::make(TagRepositoryInterface::class);
            $this->repo->setEntity($this);
        };
        return $this->repo;
    }

    public function app()
    {
        return $this->belongsTo(AppEntity::class, 'app_id');
    }

    public function tests()
    {
        return $this->hasMany(TestEntity::class, 'tag_id');
    }

}
