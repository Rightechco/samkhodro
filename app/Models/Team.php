<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'body',
        'image',
    ];
    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format('Y-n-j');
    }
}
