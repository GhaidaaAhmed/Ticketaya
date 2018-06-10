<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Category;


class Article extends Model
{
    protected $fillable = ['title', 'description' ,'photo', 'category_id' , 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}