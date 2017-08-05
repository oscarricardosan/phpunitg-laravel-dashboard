<?php

namespace Tests\Unit\General;


use App\Entities\General\AppEntity;
use Illuminate\Support\Facades\Session;
use Tests\BaseTest;

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


}