<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    private array $users = [
        0 => [
            'name' => 'admin',
            'email' => 'a@a.com',
            'role' => 'admin',
        ],
        1 => [
            'name' => 'Иванов Иван Иванович',
            'email' => 'i@a.com',
            'role' => 'user',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert($this->users);
    }
}
