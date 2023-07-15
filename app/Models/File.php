<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    // Boot function
    protected static function boot()
    {
        parent::boot();

        // Delete file from storage after delete
        static::creating(function ($file) {
            $id = $file->model_id;
            $class = strtolower(class_basename($file->model_type));
            $class = "$class/$id";
            $file->file = Storage::disk(env('FILESYSTEM_DISK','public'))->put($class, $file->file);
        });

        static::deleting(function ($file) {
            Storage::disk(env('FILESYSTEM_DISK','public'))->delete($file->file_path);
        });
    }

    protected $fillable = ['model_type','model_id','file','type','title'];

    public function getFilePathAttribute()
    {
        $filename = $this->attributes['file'];
        if(Storage::disk(env('FILESYSTEM_DISK','public'))->exists($filename)){
            return Storage::disk(env('FILESYSTEM_DISK','public'))->url($filename);
        }
        return '';
    }

    public function model()
    {
        return $this->morphTo();
    }
}
