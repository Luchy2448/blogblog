<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];
    
    use HasFactory;
    //relacion muchos a muchos polimorfica inversa
    public function posts(){
        return $this->morphedByMany(Post::class, 'taggable');
    }
}
