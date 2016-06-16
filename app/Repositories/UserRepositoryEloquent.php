<?php

namespace LaravelAngular\Repositories;

use LaravelAngular\Entities\User;
use LaravelAngular\Presenters\UserPresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function model()
    {
        return User::class;
    }

    public function presenter()
    {
        return UserPresenter::class;
    }
}