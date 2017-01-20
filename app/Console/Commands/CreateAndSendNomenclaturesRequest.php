<?php

namespace App\Console\Commands;

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
        //
    }

}
