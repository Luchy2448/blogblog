<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
    //manipulación del titulo

    protected function title(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucfirst($value),
        );}
        protected function body(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucfirst($value),
        );}
        protected function excerpt(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucfirst($value),
        );}
        protected function image(): Attribute
    {
        return new Attribute(
            get: fn () => $this->image_path ?? 'https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly7OBO5I0O5KABlN930GwaMQz.jpg'
        );}
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