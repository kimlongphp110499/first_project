<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'amount',
        'instructor_id',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function courseUser()
    {
        return $this->hasMany(UserCourse::class);
    }
}