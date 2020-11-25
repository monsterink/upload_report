<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uploadfile extends Model
{
    use HasFactory;
    protected $fillable = ['an',
                        'path',
                        'filename',
                        'status',
                        'users_id'];
    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function Role()
    {
        return $this->hasMany('App\Models\Role');
    }
}
