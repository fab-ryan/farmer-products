<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
         'slug',
         'name',
     ];

    public static $active = 'active';
    public static $inactive = 'inactive';

    public function scopeActive($scope)
    {
        return $scope->where('status', self::$active);
    }
}
