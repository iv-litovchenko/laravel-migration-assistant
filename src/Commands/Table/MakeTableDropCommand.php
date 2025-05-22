<?php

namespace Litovchenko\MigrationAssistant\Commands\Table;

use Litovchenko\MigrationAssistant\Commands\AbstractMakeCommand;

final class MakeTableDropCommand extends AbstractMakeCommand
{
    protected $signature = 'make:massist:table:drop';
    protected $stubPath = 'table/drop.stub';
    protected $fileNamePrefix = 'table_drop_';
    protected $fileNamePostfix = '.php';
    protected $argTableName = '';

    public function handle()
    {
        $this->argTableName = $this->ask('Enter table name (example: posts)');
        if ($this->confirm('Confirm?')) {
            $this->makeFile($this->argTableName);
            $this->info('Successfully completed!');
        }
    }

    public function getStubVariables()
    {
        return [
            // 'REPLACE_NAMESPACE' => 'App\\Interfaces',
            'REPLACE_CLASS_NAME' => $this->getSingularClassName($this->argTableName),
            'REPLACE_TABLE_NAME' => $this->argTableName
        ];
    }
}
