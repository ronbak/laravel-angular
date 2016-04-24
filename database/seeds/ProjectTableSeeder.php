<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \LaravelAngular\Entities\Project::truncate();
        factory(\LaravelAngular\Entities\Project::class, 10)->create();
    }
}
