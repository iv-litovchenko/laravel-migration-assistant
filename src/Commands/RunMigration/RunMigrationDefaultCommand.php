<?php

namespace Litovchenko\MigrationAssistant\Commands\RunMigration;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

final class RunMigrationDefaultCommand extends Command
{
    protected $signature = 'make:massist:runmigration:default';

    public function handle()
    {
        if ($this->confirm('Confirm?')) {
            $command = strtolower('migrate');
            Artisan::call($command, [], $this->getOutput());
        }
    }
}
