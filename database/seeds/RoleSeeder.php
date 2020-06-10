<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'student', 'id' => 3],
            ['name' => 'tutor', 'id' => 2],
            ['name' => 'admin', 'id' => 1],

        ]);
    }
}
