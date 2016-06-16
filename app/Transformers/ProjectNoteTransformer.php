<?php
/**
 * Created by PhpStorm.
 * User: Raylan
 * Date: 14/06/2016
 * Time: 18:17
 */

namespace LaravelAngular\Transformers;

use LaravelAngular\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNoteTransformer extends TransformerAbstract
{

    public function transform(ProjectNote $note)
    {
        return [
            'id' => $note->id,
            'project_id' => $note->project_id,
            'title' => $note->title,
            'note' => $note->note,
            'created_at' => $note->created_at,
            'updated_at' => $note->updated_at,
        ];
    }

}