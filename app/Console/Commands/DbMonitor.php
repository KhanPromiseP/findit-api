<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PDOException;

class DbMonitor extends Command
{
    protected $signature = 'db:monitor';
    protected $description = 'Check database connection';

    public function handle()
    {
        try {
            DB::connection()->getPdo();
            return 0;
        } catch (PDOException $e) {
            return 1;
        }
    }
}