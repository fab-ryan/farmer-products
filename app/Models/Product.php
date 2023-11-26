<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'images' => 'object',
    ];
    public static $active = 'active';
    public static $inactive = 'inactive';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function scopeActive($q)
    {
        return $q->where('status', self::$active);
    }

    public function getAttributeStatusLabel($key)
    {
        return self::${$key};
    }
}
