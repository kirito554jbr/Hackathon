<?php

namespace App\Models;

use App\Models\User;
use App\Models\Hackathone;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'score',
        'comment'
    ];
    
    public function user(){
        return $this->hasMany(User::class);
    }

    public function hackathone(){
        return $this->belongsTo(Hackathone::class);
    }

}
