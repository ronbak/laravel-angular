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
        //\LaravelAngular\Entities\User::truncate();
        factory(\LaravelAngular\Entities\User::class, 2)->create();
    }
}
