<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->withoutExceptionHandling();
        //prepare 
        
        //perform
        $response = $this->getJson('/api/users');

        //predict
        $response->assertStatus(200);
    }
}
