<?php
/**
 * Created by PhpStorm.
 * User: Raylan
 * Date: 14/06/2016
 * Time: 18:17
 */

namespace LaravelAngular\Transformers;

use LaravelAngular\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{

    public function transform(User $member)
    {
        return [
            'member_id' => $member->id,
            'member_name' => $member->name,
        ];
    }

}