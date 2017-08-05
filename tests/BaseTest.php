<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class BaseTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(\App\User::class)->create();

    }
}