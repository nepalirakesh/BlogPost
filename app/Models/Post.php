<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Author;
use App\Models\Tag;

class Post extends Model
{
    use HasFactory;

    protected $fillable=[
        'title','description','image','content','author_id','category_id',
    ];


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }



}
