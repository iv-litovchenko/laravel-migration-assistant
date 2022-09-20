<?php

namespace Litovchenko\MigrationAssistant\Commands\Table;

use Litovchenko\MigrationAssistant\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;

final class MakeTableCreatePivotCommand extends AbstractMakeCommand
{
    protected $signature = 'make:massist:table:createpivot';
    protected $stubPath = 'migration.table.createpivot.stub';
    protected $fileNamePrefix = 'table_createpivot_';
    protected $fileNamePostfix = '.php';
    protected $argTableName1 = '';
    protected $argTableName2 = '';

    public function handle()
    {
        $this->argTableName1 = $this->ask('Enter table name 1 (news)');
        $this->argTableName2 = $this->ask('Enter table name 2 (tags)');
        $names = [];
        $names[] = $this->argTableName1;
        $names[] = $this->argTableName2;
        sort($names);
        if ($this->confirm('Confirm?')) {
            $this->makeFile($names[0] . '_' . $names[1]);
            $this->info('Successfully completed!');
        }
    }

    public function getStubVariables()
    {
        $names = [];
        $names[] = $this->argTableName1;
        $names[] = $this->argTableName2;
        sort($names);
        return [
            // 'REPLACE_NAMESPACE' => 'App\\Interfaces',
            'REPLACE_CLASS_NAME' => $this->getSingularClassName($names[0]) . '_' . $this->getSingularClassName($names[1]),
            'REPLACE_TABLE_NAME' => $names[0] . '_' . $names[1],
            'REPLACE_TABLE_NAME_1' => $names[0],
            'REPLACE_TABLE_NAME_2' => $names[1],
            'REPLACE_FIELD_NAME_1' => Str::singular($names[0]),
            'REPLACE_FIELD_NAME_2' => Str::singular($names[1])
        ];
    }
}
