<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name','email','password','phone','videos'
    ];

    public function image()
    {
        return $this->morphOne(File::class, 'model')->where('type', 'image');
    }

    public function setPasswordAttribute($value)
    {
        if($value) $this->attributes['password'] = bcrypt($value);
    }

    function orders(){
        return $this->hasMany(Order::class);
    }

    function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
}
