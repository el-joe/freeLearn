<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','column_name','column_type','column_data','value','slug'
    ];

    protected $casts = [
        'column_data' => 'array'
    ];

    function getFilePathAttribute() {
        if(Storage::exists($this->value??'')) {
            return Storage::url($this->value);
        }
        return "";
    }
}
