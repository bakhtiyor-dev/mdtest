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
            'last_login_at' => 'Last login',
            'activated' => 'Activated',
            'email' => 'Email',
            'first_name' => 'First name',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
            'last_name' => 'Last name',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'test-category' => [
        'title' => 'Test Categories',

        'actions' => [
            'index' => 'Test Categories',
            'create' => 'New Test Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'title' => 'Title',
            
        ],
    ],

    'test-category' => [
        'title' => 'Test Categories',

        'actions' => [
            'index' => 'Test Categories',
            'create' => 'New Test Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'json' => 'Json',
            'title' => 'Title',
            
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
            'email' => 'Email',
            'email_verified_at' => 'Email verified at',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'password' => 'Password',
            
        ],
    ],

    'test-category' => [
        'title' => 'Test Categories',

        'actions' => [
            'index' => 'Test Categories',
            'create' => 'New Test Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'title' => 'Title',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];