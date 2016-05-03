<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //\LaravelAngular\Entities\User::truncate();
        //\LaravelAngular\Entities\Client::truncate();
        //\LaravelAngular\Entities\Project::truncate();
        //\LaravelAngular\Entities\ProjectNote::truncate();
        //\LaravelAngular\Entities\ProjectTask::truncate();
        //\LaravelAngular\Entities\ProjectMember::truncate();

        $this->call(UserTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(ProjectNoteTableSeeder::class);
        $this->call(ProjectTaskTableSeeder::class);
        $this->call(ProjectMemberTableSeeder::class);

        Model::reguard();
    }
}
