<?php

namespace LaravelAngular\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LaravelAngular\Repositories\ProjectNoteRepository;
use LaravelAngular\Entities\ProjectNote;
use LaravelAngular\Validators\ProjectNoteValidator;;

/**
 * Class ProjectNoteRepositoryEloquent
 * @package namespace LaravelAngular\Repositories;
 */
class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectNote::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
