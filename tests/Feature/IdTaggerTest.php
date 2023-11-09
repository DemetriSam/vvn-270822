<?php

namespace Tests\Feature;

use App\Services\TextFormat\IdTagger;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IdTaggerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_id_is_taged()
    {
        $input = file_get_contents(__DIR__ . '/Fixtures/html_input.html');
        $expected = file_get_contents(__DIR__ . '/Fixtures/html_expected.html');

        $tagger = new IdTagger();
        $tagger->setHtml($input);
        $result = $tagger->format();

        $this->assertEquals($result, $expected);
    }
}
