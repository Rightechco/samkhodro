<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'name',
        'nameSeo',
        'body',
        'bodySeo',
        'keyword',
        'image',
        'slug',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format('Y-n-j');
    }
    public function blog()
    {
        return $this->morphedByMany(Blog::class, 'taggables');
    }
}
