<?php

namespace LaravelAngular\Repositories;

use LaravelAngular\Entities\Project;
use Prettus\Repository\Eloquent\BaseRepository;
use LaravelAngular\Presenters\ProjectPresenter;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    public function model()
    {
        return Project::class;
    }

    public function isOwner($projectId, $userId){
        /*if(count($this->skipPresenter()->findWhere(['id' => $projectId, 'owner_id' => $userId]))){
            return true;
        }*/
        if(count($this->skipPresenter()->findWhere(['id' => $projectId, 'owner_id' => $userId]))){
            foreach ($this->findWhere(['id' => $projectId, 'owner_id' => $userId]) as $item){
                if($item->owner_id == $userId){
                    return true;
                }
            }
        }
        return false;
    }

    public function hasMember($projectId, $memberId){
        $project = $this->find($projectId);
        foreach($project->members as $member){
            if($member->id == $memberId){
                return true;
            }
        }
        return false;
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }
}
