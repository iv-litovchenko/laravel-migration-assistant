<?php

namespace Litovchenko\MigrationAssistant\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use function str_replace;
use function strtolower;

final class MigrationAssistantCommand extends Command
{
    protected $signature = 'massist';

    public function handle()
    {
        $commands = config('laravel-massist.commands');

        $this->info("");
        $this->info("╭───────────────────────────────────╮");
        $this->info("│                                   │");
        $this->info("│          Welcome v1.0.0!          │");
        $this->info("│        Migration assistant        │");
        $this->info("│                                   │");
        $this->info("╰───────────────────────────────────╯");
        $this->info("");

        $i = 1;
        $cmdAr = [];
        foreach ($commands as $kCommand => $command) {
            $cmdAr[$i++] = $kCommand;
        }

        $cmdChoiceStep1 = $this->choice(
            'Step 1: what are we creating?',
            $cmdAr,
            '',
            null,
            false
        );

        $key = array_search($cmdChoiceStep1, $commands);
        $cmdChoiceStep2 = $this->choice(
            'Step 2: what are we creating?',
            $commands[$cmdChoiceStep1],
            '',
            null,
            false
        );

        $command = str_replace(' ', '', strtolower('make:massist:' . $cmdChoiceStep1 . ':' . $cmdChoiceStep2));
        Artisan::call($command, [], $this->getOutput());
    }
}
