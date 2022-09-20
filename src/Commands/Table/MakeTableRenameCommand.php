<?php

namespace Litovchenko\MigrationAssistant\Commands\Table;

use Litovchenko\MigrationAssistant\Commands\AbstractMakeCommand;

final class MakeTableRenameCommand extends AbstractMakeCommand
{
    protected $signature = 'make:massist:table:rename';
    protected $stubPath = 'migration.table.rename.stub';
    protected $fileNamePrefix = 'table_rename_';
    protected $fileNamePostfix = '.php';
    protected $argTableName1 = '';
    protected $argTableName2 = '';

    public function handle()
    {
        $this->argTableName1 = $this->ask('Enter table name 1 (example: posts)');
        $this->argTableName2 = $this->ask('Enter table name 2 (example: new_posts)');
        if ($this->confirm('Confirm?')) {
            $this->makeFile($this->argTableName1 . '_to_' . $this->argTableName2);
            $this->info('Successfully completed!');
        }
    }

    public function getStubVariables()
    {
        return [
            // 'REPLACE_NAMESPACE' => 'App\\Interfaces',
            'REPLACE_CLASS_NAME' => $this->getSingularClassName($this->argTableName1) . '2' . $this->getSingularClassName($this->argTableName2),
            'REPLACE_TABLE_NAME_1' => $this->argTableName1,
            'REPLACE_TABLE_NAME_2' => $this->argTableName2
        ];
    }
}
