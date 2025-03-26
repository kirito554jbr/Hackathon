<?php

namespace App\Models;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable =[
        'comment'
    ];


    public function Users(){
        return $this->hasMany(User::class);
    }

    public function Projects(){
        return $this->hasMany(Project::class);
    }
}
