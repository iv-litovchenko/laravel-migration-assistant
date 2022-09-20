<?php

namespace Litovchenko\MigrationAssistant\Commands\RunMigration;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

final class RunMigrationFreshCommand extends Command
{
    protected $signature = 'make:massist:runmigration:fresh';

    public function handle()
    {
        if ($this->confirm('Confirm?')) {
            $command = strtolower('migrate:fresh');
            Artisan::call($command, [], $this->getOutput());
        }
    }
}
