<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'title'];

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
}
