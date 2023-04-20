<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Charge;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessChargesFile implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $csvFiles = Storage::files('charge_files');

        if (count($csvFiles) === 0) {
            Log::warning('O Job foi iniciado mas nenhum arquivo .csv foi encontrado para ser processado.');

            return;
        }

        $firstCsvFile = Storage::path($csvFiles[0]);

        $handle = fopen($firstCsvFile, 'r');

        if ($handle === false) {
            Log::error("Não foi possível abrir o arquivo CSV {$csvFiles[0]} para leitura.");

            return;
        }

        $currentLine = 1;

        $header = fgetcsv($handle);
        $header = array_map(fn ($h) => Str::snake($h), $header);

        while (($data = fgetcsv($handle)) !== false) {
            $currentLine++;

            try {
                Charge::create(array_combine($header, $data));
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                Log::error("Não foi possível processar os dados do arquivo CSV {$csvFiles[0]} na linha {$currentLine}.");
            }
        }

        fclose($handle);
    }
}
