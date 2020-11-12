<?php

return [
    'admin-user' => [
        'title' => 'Пользователи',

        'actions' => [
            'index' => 'Пользователи',
            'create' => 'Добавить пользователя',
            'edit' => 'Редактировать :name',
            'edit_profile' => 'Редактировать профиль',
            'edit_password' => 'Изменить пароль',
        ],

        'columns' => [
            'id' => 'ID',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'email' => 'Email',
            'password' => 'Пароль',
            'password_repeat' => 'Подтвердить Пароль',
            'activated' => 'Активировать',
            'forbidden' => 'Доступ',
            'language' => 'Язык',

            //Belongs to many relations
            'roles' => 'Роли',

        ],
    ],

    'user' => [
        'title' => 'Пользователи',

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
    'article' => [
        'title' => 'Новости/Акции',

        'actions' => [
            'index' => 'Статьи',
            'create' => 'Новая статья',
            'edit' => 'Редактировать статью :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'article_type_id' => 'Тип',
            'publish' => 'Статус',

        ],
    ],

    'article-type' => [
        'title' => 'Тип Статьи',
        'select'=> 'Выберите тип статьи',

        'actions' => [
            'index' => 'Добавить',
            'create' => 'Создать',
            'edit' => 'Редактировать :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Название',
            'status' => 'Статус',

        ],
    ],

    'comment' => [
        'title' => 'Комментарии',

        'actions' => [
            'index' => 'Добавить',
            'create' => 'Создать',
            'edit' => 'Редактировать :name',
        ],

        'columns' => [
            'id' => 'ID',
            'comment' => 'Комментарий',
            'travel_id' => 'Название путешествия',
            'users_id' => 'Имя пользователя'

        ],
    ],
    'message' => [
        'title' => 'Сообщения',

        'actions' => [
            'index' => 'Добавить',
            'create' => 'Создать',
            'edit' => 'Редактировать :name',
        ],

        'columns' => [
            'id' => '№',
            'body' => 'Сообщение'

        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];
