<?php

namespace Litovchenko\MigrationAssistant\Commands\Field;

use Litovchenko\MigrationAssistant\Commands\AbstractMakeCommand;

final class MakeFieldRenameCommand extends AbstractMakeCommand
{
    protected $signature = 'make:massist:field:rename';
    protected $stubPath = 'migration.field.rename.stub';
    protected $fileNamePrefix = 'field_rename_';
    protected $fileNamePostfix = '.php';
    protected $argTableName = '';
    protected $argFieldName1 = '';
    protected $argFieldName2 = '';

    public function handle()
    {
        $this->argTableName = $this->ask('Enter table name (example: posts)');
        $this->argFieldName1 = $this->ask('Enter field name 1 (example: bodytext)');
        $this->argFieldName2 = $this->ask('Enter field name 2 (example: new_bodytext)');

        if ($this->confirm('Confirm?')) {
            $this->makeFile($this->argTableName . '_' . $this->argFieldName1 . '_to_' . $this->argFieldName2);
            $this->info('Successfully completed!');
        }
    }

    public function getStubVariables()
    {
        return [
            // 'REPLACE_NAMESPACE' => 'App\\Interfaces',
            // 'REPLACE_CLASS_NAME' => $this->getSingularClassName($this->argTableName),
            'REPLACE_TABLE_NAME' => $this->argTableName,
            'REPLACE_FIELD_NAME_1' => $this->argFieldName1,
            'REPLACE_FIELD_NAME_2' => $this->argFieldName2,
        ];
    }
}
