<?php

declare(strict_types=1);

namespace Tests\Feature\Jobs;

use App\Jobs\ProcessChargesFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProcessChargesFileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function handle_logic(): void
    {
        $csv = file_get_contents(base_path('tests/data/example_data.csv'));
        $csvNumRecords = mb_substr_count($csv, "\n") - 1;

        Storage::fake();
        Storage::put('charge_files/charges.csv', $csv);

        $job = resolve(ProcessChargesFile::class);
        app()->call([$job, 'handle']);

        $this->assertDatabaseCount('charges', $csvNumRecords);
    }
}
