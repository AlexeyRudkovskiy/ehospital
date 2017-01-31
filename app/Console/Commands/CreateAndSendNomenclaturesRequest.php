<?php

namespace App\Console\Commands;

use App\NomenclatureRequest;
use App\NomenclatureRequestMerged;
use Illuminate\Console\Command;

class CreateAndSendNomenclaturesRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eh:nomenclature:request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Merge requests and send it to pharmacist';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $firstNomenclatureRequest = NomenclatureRequest::whereDone(0)->first();
        if ($firstNomenclatureRequest !== null) {
            $nomenclatureRequests = $firstNomenclatureRequest->department()->nomenclatureRequests()->whereDone(0)->get();

            $mergedData = [ ];

            $nomenclatureRequests->map(function ($item) {
                return $item->requested;
            })->each(function ($item) use (&$mergedData) {
                foreach ($item as $nomenclature => $amount) {
                    if (!array_key_exists($nomenclature, $mergedData)) {
                        $mergedData[$nomenclature] = 0;
                    }
                    $mergedData[$nomenclature] += $amount;
                }
            });

            $mergedRequest = NomenclatureRequestMerged::create([
                'requested' => $mergedData,
                'department_id' => $firstNomenclatureRequest->department()->id
            ]);

            if ($mergedRequest->id !== null) {
                $nomenclatureRequests->each(function (NomenclatureRequest $nomenclatureRequest) use ($mergedRequest) {
                    $nomenclatureRequest->update([
                        'done' => 1,
                        'nomenclature_request_merged_id' => $mergedRequest->id
                    ]);
                });
            } else {
                $this->out('Can\'t merge nomenclature requests');
            }
        } else {
            $this->out('Neither nomenclature should not be gnawed');
        }
    }

    public function out($text)
    {
        echo $text . "\n";
        \Log::error($text);
    }

}
