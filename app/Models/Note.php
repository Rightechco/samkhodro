<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'user_id',
        'customer_id',
    ];
    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format('H:i Y-n-j');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
}
