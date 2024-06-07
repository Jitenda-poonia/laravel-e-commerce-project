<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class CheckTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:check-table'; // by default
    protected $signature = 'check:table {table}';

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
        $tableName = $this->argument('table');

        if (Schema::hasTable($tableName)) {
            $this->info("Table '$tableName' exists.");
        } else {
            $this->error("Table '$tableName' does not exist.");
        }
    }
}
