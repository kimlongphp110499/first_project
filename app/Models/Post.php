<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'instructor_id',
    ];

    public function instructor()
    {
        return $this->belongsTo(Course::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}