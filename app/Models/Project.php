<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function categories()
    {
        return $this->belongsTo(ProjectCategory::class);
    }

    public function projectGalleries()
    {
        return $this->hasMany(ProjectGallery::class, 'project_id', 'id');
    }
}
