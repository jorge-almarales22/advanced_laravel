<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BillPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bill:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'bill of payment for the users';

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
     * @return int
     */
    public function handle()
    {
        \App\Jobs\BillPayment::dispatch();
    }
}
