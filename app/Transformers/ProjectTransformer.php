<?php
/**
 * Created by PhpStorm.
 * User: Raylan
 * Date: 14/06/2016
 * Time: 18:17
 */

namespace LaravelAngular\Transformers;

use LaravelAngular\Entities\Client;
use LaravelAngular\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['members', 'notes', 'tasks', 'client'];

    public function transform(Project $project)
    {
        return [
            'id' => $project->id,
            'client_id' => $project->client_id,
            'owner_id' => $project->owner_id,
            'name' => $project->name,
            'description' => $project->description,
            'progress' => $project->progress,
            'status' => $project->status,
            'due_date' => $project->due_date,
            'created_at' => $project->created_at,
            'updated_at' => $project->updated_at,
        ];
    }

    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMemberTransformer());
    }

    public function includeNotes(Project $project)
    {
        return $this->collection($project->notes, new ProjectNoteTransformer());
    }

    public function includeTasks(Project $project)
    {
        return $this->collection($project->tasks, new ProjectTaskTransformer());
    }

    public function includeClient(Project $project)
    {
        return $this->item($project->client, new ClientTransformer());
    }

}