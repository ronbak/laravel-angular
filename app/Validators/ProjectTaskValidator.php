<?php

namespace LaravelAngular\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator {

    protected $rules = [
        'project_id' => 'required|integer',
        'name' => 'required',
        'start_date' => 'required|date',
        'due_date' => 'required|date',
        'status' => 'required'
    ];

}