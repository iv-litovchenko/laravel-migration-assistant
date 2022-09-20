<?php

namespace Litovchenko\MigrationAssistant\Commands\Field;

use Litovchenko\MigrationAssistant\Commands\AbstractMakeCommand;

final class MakeFieldDropCommand extends AbstractMakeCommand
{
    protected $signature = 'make:massist:field:drop';
    protected $stubPath = 'migration.field.drop.stub';
    protected $fileNamePrefix = 'field_drop_';
    protected $fileNamePostfix = '.php';
    protected $argTableName = '';
    protected $argFieldName = '';

    public function handle()
    {
        $this->argTableName = $this->ask('Enter table name (example: posts)');
        $this->argFieldName = $this->ask('Enter field name (example: bodytext)');
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
