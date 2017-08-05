<?php

namespace App\Entities;


use App\Interfaces\Entities\BaseEntityInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class BaseEntity extends Model implements BaseEntityInterface
{
    use SoftDeletes;

    protected $hidden = ['deleted_at'];
}