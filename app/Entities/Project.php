<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Project extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'owner_id',
        'client_id',
        'name',
        'descripton',
        'progress',
        'status',
        'due_date',
    ];
    
    public function notes()
    {
        return $this->hasMany(ProjecNote::class);
    }
    
    public function members() 
    {
        return $this->belongsToMany(User::class,'project_members','project_id','member_id');
    }
    
    public function files() 
    {
        return $this->hasMany(ProjectFile::class);
    }

}
