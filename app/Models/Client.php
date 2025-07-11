<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    
    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function tasksIncludingTrashed()
    {
        return $this->hasMany(Task::class)->withTrashed();
    }
}
