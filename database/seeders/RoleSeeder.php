<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allRole = ['admin', 'user', 'writer'];

        foreach ($allRole as $Role) {
            $newRole = new Role();
            $newRole->name = $Role;
            $newRole->save();
        }
    }
}
