<?php

namespace Tests\Unit\General;


use Tests\BaseTest;

/**
 * @phpunitG
 */
class DashboardTest extends BaseTest
{

    /**
     * @test
     */
    public function is_index_working()
    {
        $this->actingAs($this->user);
        $response= $this->get(route('home'));
        $response->assertSee('Dashboard.Index');
    }

    /**
     * @test
     */
    public function is_index_denieding_to_guest()
    {
        $response= $this->get(route('home'));
        $response->assertRedirect('/');
    }
}