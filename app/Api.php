<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    protected $table = 'movie';
    protected $fillable = ['title','description','fillename','link'];
}
