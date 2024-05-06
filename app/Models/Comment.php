<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
   //RELACION UNO A MUCHOS inversa con user
   public function user(){
       return $this->belongsTo(User::class);
   }
   //relacion uno a muchos polimorficas
   public function images(){
        return $this->morphMany(Image::class, 'imageable');
   }
   //relacion polimorfica con post
   public function commentable(){
       return $this->morphTo();
   }
}
