<?php

namespace LaravelAngular\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'due_date',
        'progress',
        'status',
        'owner_id',
        'client_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
