<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Mesbah';
        $user->email = 'mesbah.emami@yahoo.com';
        $user->password = bcrypt('12345678');
        $user->save();
    }
}
