<?php

namespace Litovchenko\MigrationAssistant\Commands\Table;

use Litovchenko\MigrationAssistant\Commands\AbstractMakeCommand;

final class MakeTableAlterCommand extends AbstractMakeCommand
{
    protected $signature = 'make:massist:table:alter';
    protected $stubPath = 'migration.table.alter.stub';
    protected $fileNamePrefix = 'table_alter_';
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
