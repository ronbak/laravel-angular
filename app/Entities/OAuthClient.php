<?php

namespace LaravelAngular\Entities;

use Illuminate\Database\Eloquent\Model;

class OAuthClient extends Model
{
    protected $table = "oauth_clients";

    protected $fillable = [
        'id',
        'secret',
        'name',
    ];
}
