<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACCEPT = 'accept';
    public const STATUS_REJECT = 'reject';
    public static array $statuses = [
        self::STATUS_WAIT,
        self::STATUS_ACCEPT,
        self::STATUS_REJECT
    ];

    public function classStatus(): string
    {
        switch ($this->status) {
            case self::STATUS_WAIT:
                return 'info';
            case self::STATUS_ACCEPT:
                return 'success';
            case self::STATUS_REJECT:
                return 'danger';
        }
    }

    public function nameStatus(): string
    {
        switch ($this->status) {
            case self::STATUS_WAIT:
                return 'در انتظار';
            case self::STATUS_ACCEPT:
                return 'تایید شده';
            case self::STATUS_REJECT:
                return 'رد شده';
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
