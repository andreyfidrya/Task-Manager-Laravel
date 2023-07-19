<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'name'];

    public function samples()
    {
        return $this->belongsToMany(Post::class);
    }
}
