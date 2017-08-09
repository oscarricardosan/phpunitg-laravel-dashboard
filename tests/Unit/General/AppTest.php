<?php

namespace Tests\Unit\General;


use App\Entities\General\AppEntity;
use App\Entities\General\TagEntity;
use App\Entities\General\TestEntity;
use Illuminate\Support\Facades\Session;
use Tests\BaseTest;

/**
 * @phpunitG App
 */
class AppTest extends BaseTest
{
    /**
     * @test
     */
    public function is_store_working()
    {
        $this->actingAs($this->user);
        $response = $this->post(route('App.Store'), [
            'name'=> 'My app',
            'url'=> 'myapp.app',
            '_token'=> csrf_token()
        ]);
//dd(csrf_field());
        $this->assertDatabaseHas('apps', [
            'name'=> 'My app',
            'url'=> 'myapp.app',
        ]);
        $this->assertDatabaseMissing('apps', [
            'name'=> 'My app',
            'url'=> 'myapp.app',
            'token'=> null
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success', 'message', 'redirect_to'
        ], $response->json());
    }

    /**
     * @test
     */
    public function is_show_working()
    {
        $this->actingAs($this->user);
        $appEntity= factory(AppEntity::class)->create();
        $response= $this->get(route('App.Show', $appEntity));
        $response->assertSee('App.Show');
    }
    /**
     * @test
     */
    public function is_scan_tests_working()
    {
        $this->actingAs($this->user);
        $appEntity= factory(AppEntity::class)->create([
            'url'=> 'http://phpunitg-laravel.app/',
            'token'=> env('PHPUNITG_TOKEN'),
        ]);
        $response = $this->get(route('App.ScanTests', $appEntity));
//dd($response->content());
        $response->assertRedirect(route('App.Show', $appEntity));


        $this->assertDatabaseHas('tags', ['app_id'=> $appEntity->id, 'name'=> "No tag",]);
        $this->assertDatabaseHas('tags', ['app_id'=> $appEntity->id, 'name'=> 'App',]);

        $tag= TagEntity::where("name", "No tag")->get()[0];
        $this->assertDatabaseHas('tests', [
            'tag_id'=> $tag->id,
            'class'=> 'Tests\\Unit\\General\\DashboardTest',
            'path'=> '/home/vagrant/Code/phpunitg-laravel/dashboard/tests/Unit/General/DashboardTest.php',
        ]);
        $test= TestEntity::where("class", "Tests\\Unit\\General\\DashboardTest")->get()[0];
        $this->assertDatabaseHas('methods', ['test_id'=> $test->id, 'name'=> 'is_index_working',]);
        $this->assertDatabaseHas('methods', ['test_id'=> $test->id, 'name'=> 'is_index_denieding_to_guest',]);

        $tag= TagEntity::where("name", "App")->get()[0];
        $this->assertDatabaseHas('tests', [
            'tag_id'=> $tag->id,
            'class'=> 'Tests\\Unit\\General\\AppTest',
            'path'=> '/home/vagrant/Code/phpunitg-laravel/dashboard/tests/Unit/General/AppTest.php',
        ]);
        $test= TestEntity::where("class", "Tests\\Unit\\General\\AppTest")->get()[0];
        $this->assertDatabaseHas('methods', ['test_id'=> $test->id, 'name'=> 'is_store_working',]);
        $this->assertDatabaseHas('methods', ['test_id'=> $test->id, 'name'=> 'is_show_working',]);
        $this->assertDatabaseHas('methods', ['test_id'=> $test->id, 'name'=> 'is_scan_tests_working',]);
    }


}