<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newUser = new User();
        $newUser->name = 'aranna';
        $newUser->email = 'arannabaruase71@gmail.com';
        $newUser->password = Hash::make('aranna');

        $newUser->save();
        //Assign role to user after creating it in seeder file
        $newUser->assignRole('admin');
    }
}
