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
            'username' => 'admin',
            'firstname' => 'SAIFUL',
            'lastname' => 'KHAN',
            'email' => 'admin@admin.com',
            'password' => '@@QQ11qq',
            'is_admin' => 1,
            'profile_picture' => '0_admin.jpg',
        ]);
        User::create([
            'username' => 'elijah',
            'firstname' => 'DANIEL',
            'lastname' => 'GALLIS',
            'email' => 'elijahmikaelson@tvdto.com',
            'password' => '@@QQ11qq',
            'is_vendor' => 1,
            'profile_picture' => '0_elijah.jpg',
        ]);
        User::create([
            'username' => 'josie',
            'firstname' => 'KYLEE',
            'lastname' => 'BRYANT',
            'email' => 'josiesaltzman@tvdl.com',
            'password' => '@@QQ11qq',
            'profile_picture' => '0_josie.jpg',
        ]);
        User::create([
            'username' => 'caroline',
            'firstname' => 'CANDICE',
            'lastname' => 'KING',
            'email' => 'carolineforbes@tvd.com',
            'password' => '@@QQ11qq',
            'profile_picture' => '0_caroline.jpg',
        ]);
        User::create([
            'username' => 'stefan',
            'firstname' => 'PAUL',
            'lastname' => 'WESLEY',
            'email' => 'stefansalvatore@tvd.com',
            'password' => '@@QQ11qq',
            'profile_picture' => '0_stefan.jpg',
        ]);
        User::create([
            'username' => 'hope',
            'firstname' => 'DANIELLE',
            'lastname' => 'ROSE RUSSELL',
            'email' => 'hopemikaelson@tvdl.com',
            'password' => '@@QQ11qq',
            'is_vendor' => 1,
            'profile_picture' => '0_hope.jpg',
        ]);
        User::create([
            'username' => 'chandler',
            'firstname' => 'MATHEW',
            'lastname' => 'PERRY',
            'email' => 'chandlerbing@friends.com',
            'password' => '@@QQ11qq',
            'is_vendor' => 1,
            'is_admin' => 1,
            'profile_picture' => '0_chandler.jpg',
        ]);
    }
}
