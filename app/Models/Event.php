<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;
     protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'location',
        'userId',
        'coordination',
        'price',
        'quantity',
        'validation',
        'stated_at',
        'end_at',
        "categoryId"
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'userId');
    }
}
