<?php

namespace Litovchenko\MigrationAssistant\Commands\FieldRelation;

use Litovchenko\MigrationAssistant\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;

final class MakeFieldRelationAddCommand extends AbstractMakeCommand
{
    protected $signature = 'make:massist:fieldrelation:add';
    protected $stubPath = 'field-relation/add.stub';
    protected $fileNamePrefix = 'fieldref_add_';
    protected $fileNamePostfix = '.php';
    protected $argTableName1 = '';
    protected $argTableName2 = '';
    protected $argFieldName = '';
    protected $refType = '';

    public function handle()
    {
        $this->argTableName1 = $this->choice(
            'Select base table',
            $this->getAllTables(),
            '',
            null,
            false
        );

        $this->refType = $this->choice(
            'Select reference type',
            [
                1 => '1 to 1',
                2 => '1 to m',
                3 => 'm to 1',
                4 => 'm to m',
            ],
            '',
            null,
            false
        );

        print $this->refType;

        switch($this->refType) {
            case 'm to 1':

                $this->argTableName2 = $this->choice(
                    'Select reference table',
                    $this->getAllTables(),
                    '',
                    null,
                    false
                );

                $this->argFieldName = $this->choice(
                    'Select field name in reference table',
                    $this->getAllFieldsByTable($this->argTableName2),
                    '',
                    null,
                    false
                );

                // $this->argFieldName = $this->ask('Enter field name (example: refm1_user)');
                if ($this->confirm('Confirm?')) {
                    $this->makeFile($this->argTableName1 . '_refm1_' .  Str::singular($this->argTableName2));
                    $this->info('Successfully completed!');
                }

                break;

            case 'm to m':

                $this->argTableName2 = $this->choice(
                    'Select reference table',
                    $this->getAllTables(),
                    '',
                    null,
                    false
                );

                $this->argFieldName = $this->choice(
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
        return [
            // 'REPLACE_NAMESPACE' => 'App\\Interfaces',
            // 'REPLACE_CLASS_NAME' => $this->getSingularClassName($this->argTableName),
            'REPLACE_TABLE_NAME_1' => $this->argTableName1,
            'REPLACE_TABLE_NAME_2' => $this->argTableName2,
            'REPLACE_FIELDRELATION_NAME' => 'refm1_' .  Str::singular($this->argTableName2),
        ];
    }
}
