<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'role' => 'Role',
            'username' => 'Username',
            'password' => 'Password',
            'image' => 'Image',
        ],
    ],

    'clears' => [
        'name' => 'Clears',
        'index_title' => 'Clears List',
        'new_title' => 'New Clear',
        'create_title' => 'Create Clear',
        'edit_title' => 'Edit Clear',
        'show_title' => 'Show Clear',
        'inputs' => [
            'clearance_id' => 'Clearance',
            'user_id' => 'User',
            'role' => 'Role',
            'comment' => 'Comment',
            'signature' => 'Signature',
            'date' => 'Date',
            'status' => 'Status',
        ],
    ],

    'messages' => [
        'name' => 'Messages',
        'index_title' => 'Messages List',
        'new_title' => 'New Message',
        'create_title' => 'Create Message',
        'edit_title' => 'Edit Message',
        'show_title' => 'Show Message',
        'inputs' => [
            'user_id' => 'User',
            'email' => 'Email',
            'body' => 'Body',
        ],
    ],

    'students' => [
        'name' => 'Students',
        'index_title' => 'Students List',
        'new_title' => 'New Student',
        'create_title' => 'Create Student',
        'edit_title' => 'Edit Student',
        'show_title' => 'Show Student',
        'inputs' => [
            'user_id' => 'User',
            'id_number' => 'Id Number',
            'level' => 'Level',
            'block_number' => 'Block Number',
            'room_number' => 'Room Number',
        ],
    ],

    'clearances' => [
        'name' => 'Clearances',
        'index_title' => 'Clearances List',
        'new_title' => 'New Clearance',
        'create_title' => 'Create Clearance',
        'edit_title' => 'Edit Clearance',
        'show_title' => 'Show Clearance',
        'inputs' => [
            'student_id' => 'Student',
            'name' => 'Name',
            'registration_number' => 'Registration Number',
            'block_number' => 'Block Number',
            'room_number' => 'Room Number',
            'level' => 'Level',
            'hall-wadern' => 'Wadern',
            'librarian-udsm' => 'Librarian Udsm',
            'librarian-cse' => 'Librarian Cse',
            'coordinator' => 'Coordinator',
            'principal' => 'Principal',
            'smart-card' => 'Smart Card',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
