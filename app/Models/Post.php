<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'excerpt',
        'category_id',
        'user_id',
    ];

    //RELACION UNO A MUCHOS INVERSA CON USER
    public function user(){
        return $this->belongsTo(User::class);
    }
    //relacion uno a uno inversa
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //relacion muchos a muchos polimorficas
    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }
    //relacion uno a muchos polimorficas
    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
    //relacion uno a mucho polimorfica con comments
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
}