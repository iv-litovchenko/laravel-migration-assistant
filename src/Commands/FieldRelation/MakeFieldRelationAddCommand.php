<?php

namespace Litovchenko\MigrationAssistant\Commands\FieldRelation;

use Litovchenko\MigrationAssistant\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;

final class MakeFieldRelationAddCommand extends AbstractMakeCommand
{
    protected $signature = 'make:massist:fieldrelation:add';
    protected $stubPath = 'field-relation/';
    protected $fileNamePrefix = 'fieldref_add_';
    protected $fileNamePostfix = '.php';

    protected $argTableName1 = '';
    protected $argFieldName1 = '';

    protected $argTableName2 = '';
    protected $argFieldName2 = '';

    protected $refType = '';

    public function handle()
    {
        $this->refType = $this->choice(
            'Select reference type',
            [
                // 1 => '1 to 1',
                // 2 => '1 to m',
                3 => 'm to 1',
                4 => 'm to m',
            ],
            '',
            null,
            false
        );
        switch($this->refType) {
            case 'm to 1':
                $this->stubPath = 'field-relation/m1/add.stub';
                $this->argTableName1 = $this->choice(
                    'Select base table',
                    $this->getAllTables(),
                    '',
                    null,
                    false
                );
                $this->argTableName2 = $this->choice(
                    'Select reference table',
                    $this->getAllTables(),
                    '',
                    null,
                    false
                );
                $this->argFieldName2 = $this->choice(
                    'Select field name in reference table',
                    $this->getAllFieldsByTable($this->argTableName2),
                    '',
                    null,
                    false
                );
                // $this->argFieldName = $this->ask('Enter field name (example: refm1_user)');
                if ($this->confirm('Confirm?')) {
                    $this->makeFile($this->argTableName1 . '_refm1_' .  Str::singular($this->argFieldName2));
                    $this->info('Successfully completed!');
                }
                break;

            case 'm to m':
                $this->stubPath = 'field-relation/mm/add.stub';
                $this->argTableName1 = $this->choice(
                    'Select base table',
                    $this->getAllTables(),
                    '',
                    null,
                    false
                );
                $this->argFieldName1 = $this->choice(
                    'Select field name in base table',
                    $this->getAllFieldsByTable($this->argTableName1),
                    '',
                    null,
                    false
                );
                $this->argTableName2 = $this->choice(
                    'Select reference table',
                    $this->getAllTables(),
                    '',
                    null,
                    false
                );
                $this->argFieldName2 = $this->choice(
                    'Select field name in reference table',
                    $this->getAllFieldsByTable($this->argTableName2),
                    '',
                    null,
                    false
                );
                // $this->argFieldName = $this->ask('Enter field name (example: refm1_user)');
                if ($this->confirm('Confirm?')) {
                    $this->makeFile($this->argTableName1 . '_refmm_' .  Str::singular($this->argTableName2));
                    $this->info('Successfully completed!');
                }
                break;
        }

        //$this->argFieldName = $this->ask('Enter field name (example: refm1_user)');
        //if ($this->confirm('Confirm?')) {
        //    $this->makeFile($this->argTableName . '_' . $this->argFieldName);
        //    $this->info('Successfully completed!');
        //}
    }

    public function getStubVariables()
    {
        // убираем букву "s"
        // Str::singular (в единственное число)
        // Str::plural (во множественное число)
        switch($this->refType) {
            case 'm to 1':
                return [
                    // 'REPLACE_NAMESPACE' => 'App\\Interfaces',
                    // 'REPLACE_CLASS_NAME' => $this->getSingularClassName($this->argTableName),
                    'REPLACE_TABLE_NAME_1' => $this->argTableName1,
                    'REPLACE_TABLE_NAME_2' => $this->argTableName2,
                    'REPLACE_FIELDRELATION_NAME_1' => 'refm1_' . Str::singular($this->argTableName2),
                    'REPLACE_FIELDRELATION_NAME_2' => $this->argFieldName1
                ];
                break;
            case 'm to m':
                $mmTable = [];
                $mmTable[] = $this->argTableName1;
                $mmTable[] = $this->argTableName2;
                sort($mmTable);
                $mmTable = 'mm_' . implode('2', $mmTable);
                return [
                    // 'REPLACE_NAMESPACE' => 'App\\Interfaces',
                    // 'REPLACE_CLASS_NAME' => $this->getSingularClassName($this->argTableName),
                    'REPLACE_TABLE_NAME_MM' => $mmTable,
                    'REPLACE_TABLE_NAME_1' => $this->argTableName1,
                    'REPLACE_TABLE_NAME_2' => $this->argTableName2,
                    'REPLACE_FIELDRELATION_NAME' => 'refmm_' . Str::plural($this->argTableName2),
                    'REPLACE_FIELDRELATION_NAME_1' => 'refm1_' . str_replace('_id', '', $this->argFieldName1),
                    'REPLACE_FIELDRELATION_NAME_2' => 'refm1_' . str_replace('_id', '', $this->argFieldName2),
                ];
                break;
        }
    }
}
