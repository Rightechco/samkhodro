<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'title',
        'more',
        'description',
        'background',
        'slug',
        'count',
        'number',
        'status',
        'ads1',
        'ads2',
        'ads3',
    ];
}
