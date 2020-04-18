<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'email_verified_at' => 'Email verified at',
            'password' => 'Password',
            
        ],
    ],

    'category-travel' => [
        'title' => 'Category Travel',

        'actions' => [
            'index' => 'Category Travel',
            'create' => 'New Category Travel',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            
        ],
    ],

    'transport' => [
        'title' => 'Transport',

        'actions' => [
            'index' => 'Transport',
            'create' => 'New Transport',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            
        ],
    ],

    'complexity' => [
        'title' => 'Complexity',

        'actions' => [
            'index' => 'Complexity',
            'create' => 'New Complexity',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            
        ],
    ],

    'city' => [
        'title' => 'City',

        'actions' => [
            'index' => 'City',
            'create' => 'New City',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'country' => [
        'title' => 'Country',

        'actions' => [
            'index' => 'Country',
            'create' => 'New Country',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'category-travel' => [
        'title' => 'Category Travel',

        'actions' => [
            'index' => 'Category Travel',
            'create' => 'New Category Travel',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            
        ],
    ],

    'country' => [
        'title' => 'Country',

        'actions' => [
            'index' => 'Country',
            'create' => 'New Country',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'city' => [
        'title' => 'City',

        'actions' => [
            'index' => 'City',
            'create' => 'New City',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'complexity' => [
        'title' => 'Complexity',

        'actions' => [
            'index' => 'Complexity',
            'create' => 'New Complexity',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            
        ],
    ],

    'transport' => [
        'title' => 'Transport',

        'actions' => [
            'index' => 'Transport',
            'create' => 'New Transport',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            
        ],
    ],

    'city' => [
        'title' => 'Cities',

        'actions' => [
            'index' => 'Cities',
            'create' => 'New City',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'state_id' => 'State',
            'country_id' => 'Country',
            
        ],
    ],

    'city' => [
        'title' => 'City',

        'actions' => [
            'index' => 'City',
            'create' => 'New City',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'city' => [
        'title' => 'Cities',

        'actions' => [
            'index' => 'Cities',
            'create' => 'New City',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'state_id' => 'State',
            'country_id' => 'Country',
            
        ],
    ],

    'country' => [
        'title' => 'Country',

        'actions' => [
            'index' => 'Country',
            'create' => 'New Country',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'country' => [
        'title' => 'Countries',

        'actions' => [
            'index' => 'Countries',
            'create' => 'New Country',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'phonecode' => 'Phonecode',
            
        ],
    ],

    'month' => [
        'title' => 'Month',

        'actions' => [
            'index' => 'Month',
            'create' => 'New Month',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            
        ],
    ],

    'over-night-stay' => [
        'title' => 'Over Night Stay',

        'actions' => [
            'index' => 'Over Night Stay',
            'create' => 'New Over Night Stay',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            
        ],
    ],

    'travel' => [
        'title' => 'Travels',

        'actions' => [
            'index' => 'Travels',
            'create' => 'New Travel',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'budget' => 'Budget',
            'number_peoples' => 'Number peoples',
            'number_days' => 'Number days',
            'minus' => 'Minus',
            'plus' => 'Plus',
            'recommendation' => 'Recommendation',
            'description' => 'Description',
            'publish' => 'Publish',
            'visa' => 'Visa',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];