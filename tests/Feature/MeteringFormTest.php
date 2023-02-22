<?php

namespace Tests\Feature;

use App\Mail\MeteringRequested;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MeteringFormTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = collect([
            'name' => 'someName',
            'phone' => '+792342333',
            'address' => 'улица Пушкина, 2, кв. 20',
            'personal_data_confirmed' => '1',
        ]);
    }

    public function test_form_can_be_sent()
    {
        Mail::fake();

        $data = $this->data;
        $this->patch(route('request.mesurement'), $data->toArray())
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('mesurements', $data->only('name', 'phone', 'address')->toArray());
        Mail::assertSent(MeteringRequested::class);
    }

    public function test_email_contains_data()
    {
        $data = $this->data;
        $mailable = new MeteringRequested($data);

        $mailable->assertSeeInHtml($data['name']);
        $mailable->assertSeeInText($data['name']);
        $mailable->assertSeeInHtml($data['phone']);
        $mailable->assertSeeInText($data['phone']);
        $mailable->assertSeeInHtml($data['address']);
        $mailable->assertSeeInText($data['address']);
    }
}
