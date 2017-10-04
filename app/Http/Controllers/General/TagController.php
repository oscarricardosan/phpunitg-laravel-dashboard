<?php

namespace App\Http\Controllers\General;


use App\Entities\General\AppEntity;
use App\Entities\General\TagEntity;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function show(TagEntity $tagEntity)
    {
        return view('tag.show', [
            'tagEntity'=> $tagEntity
        ]);
    }

    public function showAll(AppEntity $appEntity)
    {
        return view('tag.show_all', ['appEntity'=> $appEntity]);
    }
}