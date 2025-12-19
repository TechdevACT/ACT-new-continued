<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function newsImages()
    {
        return $this->hasMany(NewsImages::class);
    }

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id', 'id');
    }
}
