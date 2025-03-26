<?php

namespace App\Models;

use App\Models\Assessment;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'subject',
        'description'
    ];

    public function Assessment(){
        return $this->belongsTo(Assessment::class);
    }
}
