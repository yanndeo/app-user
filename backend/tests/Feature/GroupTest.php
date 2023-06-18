<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_group_list()
    {
        $this->withoutExceptionHandling();
        //prepare 

        //perform
        $response = $this->getJson('/api/groups');

        //predict
        $response->assertStatus(200);
    }
}
