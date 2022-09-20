<?php

namespace Litovchenko\MigrationAssistant\Commands\RunMigration;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

final class RunMigrationForceCommand extends Command
{
    protected $signature = 'make:massist:runmigration:force';

    public function handle()
    {
        if ($this->confirm('Confirm?')) {
            $command = strtolower('migrate --force');
            Artisan::call($command, [], $this->getOutput());
        }
    }
}
