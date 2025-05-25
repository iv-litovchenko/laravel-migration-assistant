<?php

return [
    'commands' => [
        'Table' => [
            1 => 'Create',
            // 2 => 'CreatePivot // todo',
            2 => 'Rename',
            3 => 'Alter',
            4 => 'Drop'
        ],
        'Field' => [
            1 => 'Add',
            2 => 'Change',
            3 => 'Rename',
            4 => 'Move // todo',
            5 => 'Drop'
        ],
        'Field Relation' => [
            1 => 'Add',
            // 2 => 'Change',
            // 3 => 'Rename',
            // 4 => 'Move // todo',
            2 => 'Drop'
        ],
        'Index' => [ // FK
            1 => 'Index.Add',
            2 => 'Index.Drop',
            3 => 'PK.Add',
            4 => 'PK.Drop',
            5 => 'Unique.Add',
            6 => 'Unique.Drop'
        ],
        'Db content // todo' => [
            'Insert', // InsertTableConfigDataEmailStudents
            'Update',
            'Delete'
        ],
        'Seeds (-)' => [

        ],
        'Run migration' => [ // Rollback migration (-)
            1 => 'Default',
            2 => 'Force',
            3 => 'Fresh'
        ],
        'Show Help' => [
            1 => "All tables",
            2 => "All fields in table",
        ],
    ]
];
