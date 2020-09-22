<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'Admin',
            'firstname' => 'Saiful',
            'lastname' => 'Khan',
            'email' => 'admin@admin.com',
            'password' => '@@QQ11qq',
            'is_admin' => true,
        ]);
        User::create([
            'username' => 'Elijah',
            'firstname' => 'Daniel',
            'lastname' => 'Gallis',
            'email' => 'elijahmikaelson@tvdto.com',
            'password' => '@@QQ11qq',
            'is_vendor' => true,

        ]);
        User::create([
            'username' => 'Josie',
            'firstname' => 'Kylee',
            'lastname' => 'Bryant',
            'email' => 'josiesaltzman@tvdl.com',
            'password' => '@@QQ11qq',
        ]);
        User::create([
            'username' => 'Caroline',
            'firstname' => 'Candice',
            'lastname' => 'King',
            'email' => 'carolineforbes@tvd.com',
            'password' => '@@QQ11qq',
        ]);
        User::create([
            'username' => 'Stefan',
            'firstname' => 'Paul',
            'lastname' => 'Wesley',
            'email' => 'stefansalvatore@tvd.com',
            'password' => '@@QQ11qq',
        ]);
        User::create([
            'username' => 'Hope',
            'firstname' => 'Danielle',
            'lastname' => 'Rose Russell',
            'email' => 'hopemikaelson@tvdl.com',
            'password' => '@@QQ11qq',
            'is_vendor' => true,
        ]);
    }
}
