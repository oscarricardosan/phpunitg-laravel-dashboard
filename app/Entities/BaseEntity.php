<?php

namespace App\Entities;


use App\Interfaces\Entities\BaseEntityInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseEntity extends Model implements BaseEntityInterface
{
    protected $hidden = ['deleted_at'];
}