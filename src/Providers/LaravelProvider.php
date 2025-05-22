<?php

namespace Litovchenko\MigrationAssistant\Providers;

use Litovchenko\MigrationAssistant\Commands\MigrationAssistantCommand;
use Litovchenko\MigrationAssistant\Commands\Table\MakeTableAlterCommand;
use Litovchenko\MigrationAssistant\Commands\Table\MakeTableCreateCommand;
use Litovchenko\MigrationAssistant\Commands\Table\MakeTableCreatePivotCommand;
use Litovchenko\MigrationAssistant\Commands\Table\MakeTableRenameCommand;
use Litovchenko\MigrationAssistant\Commands\Table\MakeTableDropCommand;

use Litovchenko\MigrationAssistant\Commands\Field\MakeFieldAddCommand;
use Litovchenko\MigrationAssistant\Commands\Field\MakeFieldChangeCommand;
use Litovchenko\MigrationAssistant\Commands\Field\MakeFieldRenameCommand;
use Litovchenko\MigrationAssistant\Commands\Field\MakeFieldDropCommand;

use Litovchenko\MigrationAssistant\Commands\Index\MakeIndexAddCommand;
use Litovchenko\MigrationAssistant\Commands\Index\MakeIndexDropCommand;
use Litovchenko\MigrationAssistant\Commands\Index\MakeIndexPkAddCommand;
use Litovchenko\MigrationAssistant\Commands\Index\MakeIndexPkDropCommand;
use Litovchenko\MigrationAssistant\Commands\Index\MakeIndexUniqueAddCommand;
use Litovchenko\MigrationAssistant\Commands\Index\MakeIndexUniqueDropCommand;

use Litovchenko\MigrationAssistant\Commands\RunMigration\RunMigrationDefaultCommand;
use Litovchenko\MigrationAssistant\Commands\RunMigration\RunMigrationForceCommand;
use Litovchenko\MigrationAssistant\Commands\RunMigration\RunMigrationFreshCommand;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;

final class LaravelProvider extends ServiceProvider
{
    public function boot()
    {
        // AboutCommand::add('My Package', [
        //     'Version' => '1.0.0',
        //     'Driver' => fn() => config('package.driver'),
        // ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                MigrationAssistantCommand::class,

                MakeTableCreateCommand::class,
                MakeTableCreatePivotCommand::class,
                MakeTableAlterCommand::class,
                MakeTableRenameCommand::class,
                MakeTableDropCommand::class,

                MakeFieldAddCommand::class,
                MakeFieldChangeCommand::class,
                MakeFieldRenameCommand::class,
                MakeFieldDropCommand::class,

                MakeIndexAddCommand::class,
                MakeIndexDropCommand::class,
                MakeIndexPkAddCommand::class,
                MakeIndexPkDropCommand::class,
                MakeIndexUniqueAddCommand::class,
                MakeIndexUniqueDropCommand::class,

                RunMigrationDefaultCommand::class,
                RunMigrationForceCommand::class,
                RunMigrationFreshCommand::class
            ]);
        }

        // $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        // $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        // $this->loadTranslationsFrom(__DIR__ . '/../lang', 'migrationassistant');
        // $this->loadViewsFrom(__DIR__ . '/../resources/views', 'migrationassistant'); // return view('migrationassistant::dashboard');

        // $this->publishes([
        //     __DIR__.'/../resources/views' => resource_path('views/vendor/courier'),
        // ]);

        // $this->publishes(
        //     [__DIR__ . '/../../config/laravel-automatic-migrations.php' => config_path('laravel-automatic-migrations.php')],
        //     ['laravel-automatic-migrations', 'laravel-automatic-migrations:config']
        // );
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/laravel-massist.php', 'laravel-massist');
    }
}
