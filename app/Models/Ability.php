<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'percent',
    ];
    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format('Y-n-j');
    }
}
