<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new \App\Models\User();

        $userModel->insertBatch([
            ['firstname' => 'Alice', 'lastname' => 'Bob', 'email' => 'alice@test.com', 'password' => 'pass'],
            ['firstname' => 'Nut', 'lastname' => 'Boltu', 'email' => 'boltu@test.com', 'password' => 'pass'],
        ]);
    }
}
