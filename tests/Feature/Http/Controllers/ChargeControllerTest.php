<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ChargeControllerTest extends TestCase
{
    /** @test */
    public function store(): void
    {
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
    }
}
