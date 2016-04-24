<?php

namespace LaravelAngular\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator {

    protected $rules = [
        'owner_id' => 'required|numeric',
        'client_id' => 'required|numeric',
        'name' => 'required|max:255',
   ];

}