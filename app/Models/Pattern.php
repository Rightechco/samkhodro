<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'body',
    ];
    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format('H:i Y-n-j');
    }
}
