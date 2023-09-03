<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','model_id','model_type','type'
    ];

    public function image()
    {
        return $this->morphOne(File::class, 'model')->where('type', 'image');
    }

    function lessons() {
        return $this->hasMany(Lesson::class,'subject_id');
    }
}
