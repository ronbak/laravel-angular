<?php

namespace LaravelAngular\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator {

    protected $rules = [
        'owner_id' => 'required|integer',
        'client_id' => 'required|integer',
        'name' => 'required|max:255',
        'status' => 'required',
        'progress' => 'required',
        'due_date' => 'required',
   ];

}