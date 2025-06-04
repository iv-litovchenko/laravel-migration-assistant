<?php

namespace Litovchenko\MigrationAssistant\Commands\RunMigration;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

final class RunMigrationRollbackCommand extends Command
{
    protected $signature = 'make:massist:runmigration:rollback';

    public function handle()
    {
        if ($this->confirm('Confirm?')) {
            $command = strtolower('migrate:rollback --step=1');
            Artisan::call($command, [], $this->getOutput());
        }
    }
}
