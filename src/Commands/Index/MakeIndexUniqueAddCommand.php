<?php

namespace Litovchenko\MigrationAssistant\Commands\Index;

use Litovchenko\MigrationAssistant\Commands\AbstractMakeCommand;

final class MakeIndexUniqueAddCommand extends AbstractMakeCommand
{
    protected $signature = 'make:massist:index:unique.add';
    protected $stubPath = 'index/unique.add.stub';
    protected $fileNamePrefix = 'field_index_unique_add_';
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
        $this->argFieldName = $this->choice(
            'Select field name (example: id, title)',
            $this->getAllFieldsByTable($this->argTableName),
            '',
            null,
            false
        );
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
