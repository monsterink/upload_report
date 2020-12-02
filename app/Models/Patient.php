<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = ['an','name','age'];
    public function uploadfile()
    {
        return $this->hasMany('App\Models\uploadfile');
    }
}
