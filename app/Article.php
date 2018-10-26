<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Article extends Model
{
    protected $fillable = [
        'title', 'website_name', 'webUrl', 'brief_description', 'category_id',
     ];

     public function articles(){
         return $this->belongsTo('App\Category');
     }
}
