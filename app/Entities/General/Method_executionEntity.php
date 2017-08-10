<?php

namespace App\Entities\General;


use App\Entities\BaseEntity;
use App\Interfaces\Repositories\General\Method_executionRepositoryInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Method_executionEntity extends BaseEntity
{
    use SoftDeletes;

    protected $table= 'method_executions';

    /**
     * @return Method_executionRepositoryInterface
     */
    public function getRepo()
    {
        $repo= App::make(Method_executionRepositoryInterface::class);
        return $repo->setEntity($this);
    }

    /**
     * @ACCESSORS
     */
    public function getHtmlMessageAttribute()
    {
        //dd($this->message);
        $html= htmlentities($this->message);
        $html= str_replace(" ", "&nbsp;", $html);
        $html= str_replace("\n", "<br>", $html);
        $html= str_replace("\\n", "<br>", $html);
        $html= str_replace("\\r", "<br>", $html);
        $html= str_replace("\r", "<br>", $html);
        return $html;
    }
}