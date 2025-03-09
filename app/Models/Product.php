<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'title',
        'body',
        'image',
        'sku',
        'slug',
        'count',
        'price',
        'priceF',
        'titleSeo',
        'bodySeo',
        'user_id',
        'keywordSeo',
        'imageAlt',
    ];

    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format(' %d / %B / %Y');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function category()
    {
        return $this->morphedByMany(Category::class, 'productables');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id' , 'id');
    }
}
