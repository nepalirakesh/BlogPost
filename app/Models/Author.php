<?php

namespace App\Models;
<<<<<<< HEAD
use App\Models\Post;
=======
>>>>>>> main

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
<<<<<<< HEAD

    protected $fillable =[
        'name','description','image',
    ];

    public function post(){
        return $this->hasMany(Post::class);
    }
=======
>>>>>>> main
}
