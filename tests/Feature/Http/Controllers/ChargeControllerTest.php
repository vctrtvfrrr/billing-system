<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Jobs\ProcessChargesFile;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ChargeControllerTest extends TestCase
{
    /** @test */
    public function store(): void
    {
        Storage::fake();
        Queue::fake();

        $chargesFile = UploadedFile::fake()->createWithContent(
            'charges.csv',
            file_get_contents(base_path('tests/data/example_data.csv'))
        );

        $response = $this->post(
            route('charges'),
            ['charges' => $chargesFile],
            ['Accept'  => 'application/json', 'Content-Type' => 'multipart/form-data']
        );

        $response->assertStatus(Response::HTTP_CREATED);

        Queue::assertPushed(ProcessChargesFile::class);
    }
}
