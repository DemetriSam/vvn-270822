<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\PrCvet;

class PrCvetTest extends TestCase
{
    /**
     * A basic feature test example.
     * @group pr_cvet_tests
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * 
     * @group pr_cvet_tests
     */
    public function test_images()
    {
        
    }
}
