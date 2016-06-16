<?php
/**
 * Created by PhpStorm.
 * User: Raylan
 * Date: 14/06/2016
 * Time: 18:17
 */

namespace LaravelAngular\Transformers;

use LaravelAngular\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformer extends TransformerAbstract
{

    public function transform(ProjectTask $task)
    {
        return [
            'id' => $task->id,
            'name' => $task->name,
            'project_id' => $task->project_id,
            'start_date' => $task->start_date,
            'status' => $task->status,
            'due_date' => $task->due_date,
            'created_at' => $task->created_at,
            'updated_at' => $task->updated_at,
        ];
    }

}