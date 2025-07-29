<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\Task\Status;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $casts = [
        'status' => Status::class
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function notification(){
        return $this->belongsTo(User::class);
    }
}
