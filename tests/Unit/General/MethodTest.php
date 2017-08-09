<?php

namespace Tests\Unit\General;
use App\Entities\General\AppEntity;
use App\Entities\General\MethodEntity;
use App\Entities\General\TagEntity;
use App\Entities\General\TestEntity;
use Tests\BaseTest;


/**
 * @phpunitG Method
 */
class MethodTest extends BaseTest
{

    /**
     * @test
     */
    public function is_run_working()
    {
        $this->actingAs($this->user);
        $appEntity= factory(AppEntity::class)->create([
            'url'=> 'http://phpunitg-laravel.app/',
            'token'=> env('PHPUNITG_TOKEN'),
        ]);
        $tagEntity= factory(TagEntity::class)->create([
            'app_id'=> $appEntity->id
        ]);
        $testEntity= factory(TestEntity::class)->create([
            'tag_id'=> $tagEntity->id,
            'class'=> "Tests\Unit\General\AppTest",
            'path'=> "/home/vagrant/Code/phpunitg-laravel/dashboard/tests/Unit/General/AppTest.php",
        ]);
        $methodEntity= factory(MethodEntity::class)->create([
            'test_id'=> $testEntity->id,
            'name'=> 'is_show_working'
        ]);
        $response= $this->get(route('Method.Run', $methodEntity));
        $response->assertJsonStructure(['success', 'message'], $response->json());

        $this->assertDatabaseHas('method_executions', [
            'success'=> true,
            'method_id'=> $methodEntity->id,
        ]);

        $this->assertDatabaseMissing('method_executions', [
            'success'=> true,
            'method_id'=> $methodEntity->id,
            'message'=> null,
        ]);
    }

}