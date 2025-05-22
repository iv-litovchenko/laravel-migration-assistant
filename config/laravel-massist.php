<?php

return [
    'commands' => [
        'Table' => [
            1 => 'Create',
            2 => 'CreatePivot // todo',
            3 => 'Rename',
            4 => 'Alter',
            5 => 'Drop'
        ],
        'Field' => [
            1 => 'Add',
            2 => 'Change',
            3 => 'Rename',
            4 => 'Move // todo',
            5 => 'Drop'
        ],
        'Field relation' => [
            1 => 'Add',
            2 => 'Change',
            3 => 'Rename',
            4 => 'Drop'
        ],
        'Index' => [
            1 => 'PK.Add',
            2 => 'PK.Rename',
            3 => 'PK.Drop'
        ],
        'FK (-)' => [

        ],
        'Db content (-)' => [
            'Insert', // InsertTableConfigDataEmailStudents
            'Update',
            'Delete'
        ],
        'Seeds (-)' => [

        ],
        'Rollback migration (-)' => [],
        'Run migration' => [
            1 => 'Default',
            2 => 'Force',
            3 => 'Fresh'
        ]
    ]
];
