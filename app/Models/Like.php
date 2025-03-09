<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_ip',
        'user_id',
        'likable_id',
        'likable_type',
    ];
    public function getCreatedAtAttribute($value)
    {
        return verta($value)->formatDifference();
    }
    public function likable()
    {
        return $this->morphTo();
    }
}
