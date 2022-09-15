<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\PrImage;

class PrImageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected $pr_image;

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @group pr_image_tests
     */
    public function make_resizes()
    {
        $file_path = 'pr_collection_images/0ZDCQaCozLUxjWAfOObxX20rIFbOlQN3W4FMFcSs.jpg';
        $pr_image = PrImage::create(['orig_img' => $file_path]);

        $pr_image->make_resizes([
            ['product', 574, 574],
            ['product', 689, 689],
            ['product', 861, 861],
            ['product', 1148, 1148],
            ['product', 414, 700],
            ['product', 621, 1050],
            ['product', 828, 1400],
            ['rec', 320, 320],
            ['rec', 480, 480],
            ['rec', 640, 640],
            ['rec', 325, 325]
        ]);
         
        collect(json_decode($pr_image->resizes))->dump();

        $pr_image->save();

        $this->pr_image = $pr_image;

    }

    /**
     * @group pr_image_tests
     */
    public function test_get_resize()
    {

        $this->make_resizes();

        $result = $this->pr_image->get_resize('325x325');
        print_r($result);

        $get_path_in_filesystem = true;
        $result = $this->pr_image->get_resize('325x325', $get_path_in_filesystem);
        $this->assertFileExists($result);
    }

    
}
