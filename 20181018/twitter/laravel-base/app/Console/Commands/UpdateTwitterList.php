<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateTwitterList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates our Twitter list with new interactions';

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
