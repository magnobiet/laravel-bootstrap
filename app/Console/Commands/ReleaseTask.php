<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ReleaseTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:release';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for post release in heroku';

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
        // Turn on maintenance mode
        $this->call("down");

        // Clear caches
        $this->call("cache:clear");

        // Clear expired password reset token
        $this->call("auth:clear-resets");

        // Clear and cache routes
        $this->call("route:clear");
        $this->call("route:cache");

        // Clear and cache config
        $this->call("config:clear");
        $this->call("config:cache");

        // Turn off maintenance mode
        $this->call("up");
    }
}
