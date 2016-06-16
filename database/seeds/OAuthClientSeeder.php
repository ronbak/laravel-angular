<?php

use Illuminate\Database\Seeder;

class OAuthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \LaravelAngular\Entities\OAuthClient::create([
            'id' => 'appid1',
            'name' => 'AngulaAPP',
            'secret' => 'secret',
        ]);
    }
}
