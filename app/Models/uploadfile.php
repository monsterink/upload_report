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
                        'users_id',
                        'users_id_print'];
    public function User()
    {
        return $this->belongsTo('App\Models\User','users_id','id');
    }
    public function Role()
    {
        return $this->hasMany('App\Models\Role');
    }
    public function Patient()
    {
        return $this->belongsTo('App\Models\Patient','an','an');
    }
}
