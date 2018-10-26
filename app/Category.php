<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Article;

class Category extends Model
{
    protected $fillable = [
        'title',
     ];

     public function articles(){
         return $this->hasMany('App\Article');
     }
}
