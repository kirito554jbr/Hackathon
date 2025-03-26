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
    // $team->name = "ASCasc";
    // $team->score  = 12 ; 
    // $team->Comment = "CAascascasc";
    // $team->user()->associate($user);by this 
    // $team->save();
    // $team->user_id = 1 ;this changed by ^

    // public function User(){
    //     return $this->hasOne(User::class);
    // }
    public function user(){
        return $this->hasMany(User::class);
    }

    public function hackathone(){
        return $this->belongsTo(Hackathone::class);
    }

}
