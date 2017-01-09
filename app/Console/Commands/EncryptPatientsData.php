<?php

namespace App\Console\Commands;

use App\Patient;
use Illuminate\Console\Command;

class EncryptPatientsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'patient:encrypt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encrypt patients data';

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
        $this->info('Encrypting patients data');

        $patiens = Patient::where('user_id', 1)->get();
        auth()->loginUsingId(1);

        $patiens->each(function (Patient $patient) {
            $patient->encrypt();
            $patient->save();
        });
        $patiens = Patient::where('user_id', 2)->get();
        auth()->loginUsingId(2);

        $patiens->each(function (Patient $patient) {
            $patient->encrypt();
            $patient->save();
        });
    }

}
