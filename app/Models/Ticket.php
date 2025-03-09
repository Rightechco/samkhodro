<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'status',
        'file_id',
        'user_id',
        'catch_id',
        'parent_id',
    ];
    public function getCreatedAtAttribute($value)
    {
        return verta($value)->formatDifference();
    }
    public function image()
    {
        return $this->belongsTo(Gallery::class, 'file_id' , 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id' , 'id');
    }
    public function catch()
    {
        return $this->belongsTo(User::class, 'catch_id' , 'id');
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'parent_id' , 'id');
    }
}
