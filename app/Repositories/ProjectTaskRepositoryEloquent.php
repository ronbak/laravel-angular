<?php

namespace LaravelAngular\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LaravelAngular\Repositories\ProjectTaskRepository;
use LaravelAngular\Entities\ProjectTask;
use LaravelAngular\Validators\ProjectTaskValidator;;

/**
 * Class ProjectTaskRepositoryEloquent
 * @package namespace LaravelAngular\Repositories;
 */
class ProjectTaskRepositoryEloquent extends BaseRepository implements ProjectTaskRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectTask::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
