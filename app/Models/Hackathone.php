<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

class Hackathone extends Model
{
    protected $fillable = [
        'title',
        'start_date',
        'expiration_date',
        'status',
        'roles',
        'edition',
        'subject',
    ];

    public function teams(){
        return $this->hasMany(Team::class);
    }
}
