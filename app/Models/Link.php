<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'slug',
        'parent_id'
    ];
    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format(' %d / %B / %Y');
    }

    public function parent()
    {
        return $this->belongsTo(__CLASS__,'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(__CLASS__,'parent_id');
    }
}
