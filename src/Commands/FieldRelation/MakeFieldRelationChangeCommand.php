<?php

namespace Litovchenko\MigrationAssistant\Commands\FieldRelation;

use Litovchenko\MigrationAssistant\Commands\AbstractMakeCommand;

final class MakeFieldRelationChangeCommand extends AbstractMakeCommand
{
    protected $signature = 'make:massist:fieldrelation:change';
    protected $stubPath = 'field-relation/change.stub';
    protected $fileNamePrefix = 'fieldref_change_';
    protected $fileNamePostfix = '.php';
    protected $argTableName = '';
    protected $argFieldName = '';

    public function handle()
    {
        $this->argTableName = $this->choice(
            'Select table name (example: posts)',
            $this->getAllTables(),
            '',
            null,
            false
        );
        $this->argFieldName = $this->ask('Enter field name (example: title)');
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
