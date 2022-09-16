<?php

namespace Litovchenko\Migrationassistant\Providers;

use Litovchenko\Migrationassistant\Commands\MigrationassistantCommand;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;

class LaravelProvider extends ServiceProvider
{
    public function boot()
    {
        // AboutCommand::add('My Package', [
        //     'Version' => '1.0.0',
        //     'Driver' => fn() => config('package.driver'),
        // ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                MigrationassistantCommand::class
            ]);
        }

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'migrationassistant');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'migrationassistant'); // return view('migrationassistant::dashboard');

        // $this->publishes([
        //     __DIR__.'/../resources/views' => resource_path('views/vendor/courier'),
        // ]);

        // $this->publishes(
        //     [__DIR__ . '/../../config/laravel-automatic-migrations.php' => config_path('laravel-automatic-migrations.php')],
        //     ['laravel-automatic-migrations', 'laravel-automatic-migrations:config']
        // );
        //
        // $this->publishes(
        //     [__DIR__ . '/../../resources/stubs' => resource_path('stubs/vendor/laravel-automatic-migrations')],
        //     ['laravel-automatic-migrations', 'laravel-automatic-migrations:stubs']
        // );
    }

    public function register()
    {
        // $this->mergeConfigFrom(__DIR__ . '/../../config/laravel-automatic-migrations.php', 'laravel-automatic-migrations');
    }
}
