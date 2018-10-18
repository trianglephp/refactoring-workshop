<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TwitterLists extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:lists';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays all of our Twitter lists';

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
        $connection = app('Twitter');
        $lists = $connection->get('lists/ownerships', ['user_id' => (int)config('services.twitter.user')]);

        $this->table(['id', 'name'], collect(data_get($lists, 'lists', []))->map(function ($list) {
            return [$list->id, $list->name];
        })->toArray());
    }
}
