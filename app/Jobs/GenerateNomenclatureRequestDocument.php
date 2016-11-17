<?php

namespace App\Jobs;

use App\NomenclatureRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateNomenclatureRequestDocument implements ShouldQueue
{

    use Queueable, SerializesModels;

    /**
     * @var NomenclatureRequest
     */
    public $nomenclatureRequest = null;

    /**
     * Create a new job instance.
     *
     * @param NomenclatureRequest $nomenclatureRequest
     */
    public function __construct(NomenclatureRequest $nomenclatureRequest)
    {
        $this->nomenclatureRequest = $nomenclatureRequest;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo 3;
    }

}
