<?php

namespace App\Entities\General;

use App\Entities\BaseEntity;
use App\Interfaces\Repositories\General\AppRepositoryInterface;
use Illuminate\Support\Facades\App;

class AppEntity extends BaseEntity
{
    protected $table = 'apps';

    /**
     * @return AppRepositoryInterface
     */
    public function getRepo()
    {
        $repo= App::make(AppRepositoryInterface::class);
        return $repo->setEntity($this);
    }

    public function tags()
    {
        return $this->hasMany(TagEntity::class, 'app_id');
    }

}
