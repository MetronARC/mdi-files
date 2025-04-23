<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run()
    {
        // Seed auth_groups
        $groups = [
            [
                'id' => 1,
                'name' => 'admin',
                'description' => 'Site Administrator'
            ],
            [
                'id' => 2,
                'name' => 'user',
                'description' => 'Regular User'
            ]
        ];
        $this->db->table('auth_groups')->insertBatch($groups);

        // Seed auth_permissions
        $permissions = [
            [
                'id' => 1,
                'name' => 'manage-users',
                'description' => 'Manage All Users'
            ],
            [
                'id' => 2,
                'name' => 'manage-profile',
                'description' => 'Manage User\'s Profile'
            ]
        ];
        $this->db->table('auth_permissions')->insertBatch($permissions);

        // Seed initial admin user
        $users = [
            [
                'id' => 1,
                'email' => 'marinternet.id@gmail.com',
                'username' => 'mdi',
                'password_hash' => password_hash('cintafitri123', PASSWORD_DEFAULT),
                'active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('users')->insertBatch($users);

        // Assign admin user to admin group
        $groupUsers = [
            [
                'group_id' => 1, // admin group
                'user_id' => 1 // admin user
            ]
        ];
        $this->db->table('auth_groups_users')->insertBatch($groupUsers);
    }
} 