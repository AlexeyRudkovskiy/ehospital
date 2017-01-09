<?php

namespace App\Jobs;

use App\File;
use App\NomenclatureRequest;
use Carbon\Carbon;
use FPDI;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use League\Flysystem\Exception;

class GenerateNomenclatureRequestDocument implements ShouldQueue
{

    use Queueable, SerializesModels;

    private $filenameTag = 'nomenclature_request_file';

    /**
     * @var NomenclatureRequest
     */
    public $nomenclatureRequest = null;

    /**
     * @var File
     */
    public $file;

    /**
     * Create a new job instance.
     *
     * @param NomenclatureRequest $nomenclatureRequest
     */
    public function __construct(NomenclatureRequest $nomenclatureRequest)
    {
        $this->nomenclatureRequest = $nomenclatureRequest;
        $this->file = $nomenclatureRequest->file()->create([
            'status' => 'in_process'
        ]);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pdf = new FPDI();
        $pdf->setSourceFile(storage_path('app/templates/nomenclature_request.pdf'));
        $tplIdx = $pdf->importPage(1);

        $pdf->addPage();
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);

        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(30, 30);
        $pdf->Write(0, "Hello world");

        $filename = md5(sha1(Carbon::now()) . $this->filenameTag) . '.pdf';

        $pdf->Output(storage_path('app/public/files/' . $filename), 'F');
        $this->file->path = public_path('storage/files/' . $filename);
        $this->file->status = 'done';
        $this->file->save();
    }

}
