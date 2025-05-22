<?php

namespace Litovchenko\MigrationAssistant\Commands\Index;

use Litovchenko\MigrationAssistant\Commands\AbstractMakeCommand;

final class MakeIndexPkAddCommand extends AbstractMakeCommand
{
    protected $signature = 'make:massist:index:pk.add';
    protected $stubPath = 'index/primary.add.stub';
    protected $fileNamePrefix = 'field_add_';
    protected $fileNamePostfix = '.php';
    protected $argTableName = '';
    protected $argFieldName = '';

    public function handle()
    {
        $this->argTableName = $this->ask('Enter table name (example: posts)');
        $this->argFieldName = $this->ask('Enter field name (example: id, title)');
        if ($this->confirm('Confirm?')) {
            $this->makeFile($this->argTableName . '_' . $this->argFieldName);
            $this->info('Successfully completed!');
        }
    }

    public function getStubVariables()
    {
        return [
            // 'REPLACE_NAMESPACE' => 'App\\Interfaces',
            // 'REPLACE_CLASS_NAME' => $this->getSingularClassName($this->argTableName),
            'REPLACE_TABLE_NAME' => $this->argTableName,
            'REPLACE_FIELD_NAME' => $this->argFieldName,
        ];
    }
}
