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
        $patiens = Patient::where('user_id', 1)->get();
        auth()->loginUsingId(1);
        $patiens->each($this->eachCallback);
        $patiens = Patient::where('user_id', 2)->get();
        auth()->loginUsingId(2);
        $patiens->each($this->eachCallback);
    }

    public function eachCallback(Patient $patient) {
        $patient->setEncrypted([]);
        $name = $patient->name;
        $birthday = $patient->birthday;
        $phone = $patient->phone;
        $homeless = $patient->homeless;
        $ukrainian = $patient->ukrainian;
        $hospital_employee = $patient->hospital_employee;

        $patient->setEncrypted([
            'name', 'birthday', 'phone', 'homeless', 'ukrainian', 'hospital_employee'
        ]);

        $patient->name = $name;
        $patient->birthday = $birthday;
        $patient->phone = $phone;
        $patient->homeless = $homeless;
        $patient->ukrainian = $ukrainian;
        $patient->hospital_employee = $hospital_employee;
        $patient->save();
    }

}
