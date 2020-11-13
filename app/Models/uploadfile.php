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
                        'status'];
}
