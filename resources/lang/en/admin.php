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
            'phone' => 'Phone',
            
        ],
    ],

    'exam' => [
        'title' => 'Exams',

        'actions' => [
            'index' => 'Exams',
            'create' => 'New Exam',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'attempts_count' => 'attempts count',
            'can_complete_untill_all_answered' => 'Can complete untill all answered',
            'can_return_to_passed_question' => 'Can return to passed question',
            'can_skip_question' => 'Can skip question',
            'description' => 'Description',
            'enable_explanation' => 'Enable explanation',
            'end_date' => 'End date',
            'start_date' => 'Start date',
            'test_category_count' => 'Test category count',
            'time' => 'Time',
            
        ],
    ],

    'test' => [
        'title' => 'Tests',

        'actions' => [
            'index' => 'Tests',
            'create' => 'New Test',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'answers_id' => 'Answers',
            'answers_type' => 'Answers type',
            'body' => 'Body',
            'status' => 'Status',
            'test_category_id' => 'Test category',
            
        ],
    ],

    'organisation' => [
        'title' => 'Organisations',

        'actions' => [
            'index' => 'Organisations',
            'create' => 'New Organisation',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
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
            'login' => 'Login',
            'password' => 'Password',
            'email' => 'Email',
            'fullname' => 'Fullname',
            'position' => 'Position',
            'department' => 'Department',
            'organisation' => 'Organisation',
            
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

    'admin-user' => [
        'title' => 'Admin-Users',

        'actions' => [
            'index' => 'Admin-Users',
            'create' => 'New Admin-User',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'admin-user' => [
        'title' => 'Admin Users',

        'actions' => [
            'index' => 'Admin Users',
            'create' => 'New Admin User',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'activated' => 'Activated',
            'email' => 'Email',
            'first_name' => 'First name',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
            'last_name' => 'Last name',
            'password' => 'Password',
            
        ],
    ],

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

    // Do not delete me :) I'm used for auto-generation
];