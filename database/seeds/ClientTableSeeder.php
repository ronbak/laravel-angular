<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \LaravelAngular\Client::truncate();
        factory(\LaravelAngular\Client::class, 10)->create();
    }
}
