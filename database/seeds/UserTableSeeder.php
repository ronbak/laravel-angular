<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\LaravelAngular\Entities\User::class, 2)->create([
            'name' => 'Raylan',
            'email' => 'raylan@raylansoares.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);
        factory(\LaravelAngular\Entities\User::class, 2)->create();
    }
}
