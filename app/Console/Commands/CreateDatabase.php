<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $database   = Config::get('database.connections.mysql.database');
        $username   = Config::get('database.connections.mysql.username');
        $password   = Config::get('database.connections.mysql.password');
        $host       = Config::get('database.connections.mysql.host');

        Config::set('database.connections.mysql.database', null);
        DB::purge('mysql');

        try {
            DB::statement("CREATE DATABASE IF NOT EXISTS `$database`");
            $this->info("Database '$database' created successfully!");

            Config::set('database.connections.mysql.database', $database);
            DB::reconnect('mysql');

        } catch (\Exception $e) {
            $this->error("Error creating database: " . $e->getMessage());
        }
    }
}
