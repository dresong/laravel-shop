<?php

namespace Dresong\LaravelShop\Wap\Member\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wap-member:install {name=foo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description for wap-member:install';

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
        echo "wap-member:install balalaba.....".$this->argument('name');
        $this->call('migrate');
        $this->call('vendor:publish', ['--provider' => 'Dresong\LaravelShop\Wap\Member\Providers\MemberServiceProvider',]);
    }
}
