<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Application name
      |--------------------------------------------------------------------------
      |
      | The name of the application: this name will be used as title and as header
      | in the application
      |
     */

    "tasks_admin_per_page" => 5,
    "statuses_admin_per_page" => 5,
    "faqs_admin_per_page" => 5,
    "category_admin_per_page" => 5,
    "levels_admin_per_page" => 5,
    "ajax_user_search_per_page" => 10,


    'libfiles' => [
        /**
         * Tasks
         */
        'task' => [
            'filetype' => [
                'jpg', 'png', 'gif'
            ],
            'filesize' => [
                'max' => 3
            ],
            'filepath' => 'public/packages/media/tasks',
            'urlpath' => 'packages/media/tasks',
            'prename' => 't_'
        ],
        /**
         * Faqs
         */
        'faq' => [
            'filetype' => [
                'jpg', 'png', 'gif'
            ],
            'filesize' => [
                'max' => 3
            ],
            'filepath' => 'public/packages/media/faqs',
            'urlpath' => 'packages/media/faqs',
            'prename' => 't_'
        ],

        /**
         * Categories
         */
        'category' => [
            'filetype' => [
                'jpg', 'png', 'gif'
            ],
            'filesize' => [
                'max' => 3
            ],
            'filepath' => 'public/packages/media/categories',
            'urlpath' => 'packages/media/categories',
            'prename' => 'c_'
        ],
        /**
         * Posts
         */
        'post' => [
            'filetype' => [
                'jpg', 'png', 'gif'
            ],
            'filesize' => [
                'max' => 3
            ],
            'filepath' => 'public/packages/media/posts',
            'urlpath' => 'packages/media/posts',
            'prename' => 'p_'
        ],
        
        /**
         * Levels
         */
        'level' => [
            'filetype' => [
                'jpg', 'png', 'gif'
            ],
            'filesize' => [
                'max' => 3
            ],
            'filepath' => 'public/packages/media/levels',
            'urlpath' => 'packages/media/levels',
            'prename' => 'l_'
        ],
    ]
];
