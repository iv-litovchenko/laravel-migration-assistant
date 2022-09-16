<?php

namespace Litovchenko\Migrationassistant\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MigrationassistantCommand extends Command
{
    // php artisan make:migration create_flights_table
    protected $signature = 'make:migassist';

    public function handle()
    {
        $this->info("");
        $this->info("╭─────────────────────╮");
        $this->info("│                     │");
        $this->info("│      Welcome!       │");
        $this->info("│                     │");
        $this->info("╰─────────────────────╯");
        $this->info("");

        $cmdAr = [];
        $cmdAr[1] = 'Table';
        $cmdAr[2] = 'Field';
        $cmdAr[3] = 'FK';
        $cmdAr[4] = 'Index';
        $cmdAr[5] = 'Db content';
        $cmdChoice = $this->choice(
            'What are we creating?',
            $cmdAr,
            '',
            null,
            false
        );

        switch ($cmdChoice) {
            case $cmdAr[1]:
                $this->cmdTable();
                break;
            case $cmdAr[2]:
                $this->cmdField();
                break;
        }
    }

    public function cmdTable()
    {
        $cmdAr = [];
        $cmdAr[1] = 'Create';
        $cmdAr[2] = 'Create (pivot)';
        $cmdAr[3] = 'Alter';
        $cmdAr[4] = 'Drop';
        $cmdChoice = $this->choice(
            'What are we creating?',
            $cmdAr,
            '',
            null,
            false
        );

        switch ($cmdChoice) {
            case $cmdAr[1]:
                $name = $this->ask('Enter table name:');
                $command = 'make:migration create_' . $name . '_table';
                break;
        }

        if ($this->confirm('Execute the command: "' . $command . '"?')) {
            Artisan::call($command, [], $this->getOutput());
            $this->info('Successfully completed!');
        }

        //
    }
}
