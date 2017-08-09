<?php

namespace Tests\Unit\General;
use App\Entities\General\AppEntity;
use App\Entities\General\TagEntity;
use Tests\BaseTest;


/**
 * @phpunitG Tag
 */
class TagTest extends BaseTest
{

    /**
     * @test
     */
    public function is_show_working()
    {
        $this->actingAs($this->user);
        $appEntity= factory(AppEntity::class)->create();
        $tagEntity= factory(TagEntity::class)->create([
            'app_id'=> $appEntity->id
        ]);
        $response= $this->get(route('Tag.Show', $tagEntity));
        $response->assertSee('Tag.Show');
    }

}