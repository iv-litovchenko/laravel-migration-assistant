<?php

return [
    'commands' => [
        'Table' => [
            1 => 'Create',
            2 => 'CreatePivot',
            3 => 'Rename',
            4 => 'Alter',
            5 => 'Drop'
        ],
        'Field' => [
            1 => 'Add',
            2 => 'Change',
            3 => 'Rename',
            4 => 'Drop'
        ],
        'FK (-)' => [

        ],
        'Index (-)' => [

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
