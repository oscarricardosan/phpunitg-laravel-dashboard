<?php

namespace Tests\Unit\General;


use App\Entities\General\AppEntity;
use Illuminate\Support\Facades\Session;
use Tests\BaseTest;

/**
 * @phpunitG
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
        ]);
//dd(Session::get('errors'));
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


        $this->assertDatabaseHas('tests', [
            'app_id'=> $appEntity->id,
            'class'=> 'Tests\\Unit\\General\\DashboardTest',
            'path'=> '/home/vagrant/Code/phpunitg-laravel/dashboard/tests/Unit/General/DashboardTest.php',
        ]);
        $this->assertDatabaseHas('test_methods', [
            'name'=> 'is_index_working',
            'test_id'=> '',
        ]);
        $this->assertDatabaseHas('test_methods', [
            'name'=> 'is_index_denieding_to_guest',
            'test_id'=> '',
        ]);


        $this->assertDatabaseHas('tests', [
            'app_id'=> $appEntity->id,
            'class'=> 'Tests\\Unit\\General\\AppTest',
            'path'=> '/home/vagrant/Code/phpunitg-laravel/dashboard/tests/Unit/General/AppTest.php',
        ]);
        $this->assertDatabaseHas('test_methods', [
            'name'=> 'is_store_working',
            'test_id'=> '',
        ]);
        $this->assertDatabaseHas('test_methods', [
            'name'=> 'is_show_working',
            'test_id'=> '',
        ]);
        $this->assertDatabaseHas('test_methods', [
            'name'=> 'is_scan_tests_working',
            'test_id'=> '',
        ]);
    }


    /**Leer error de consola

    chdir(base_path());
    $salida= exec(
    "vendor/bin/phpunit --bootstrap=bootstrap/autoload.php --configuration=phpunit.xml ".
    "--filter='Tests\\\\Unit\\\\General\\\\DashboardTest::is_index_working' ".
    " >log.txt"
    );
    $file= file_get_contents('log.txt');
    dd($file);

     */

}