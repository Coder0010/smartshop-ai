<?php

namespace App\Models;

use Illuminate\Support\Str;
use MkamelMasoud\StarterCoreKit\Core\BaseEntity;

/**
 * @property string|null $image
 */
class Product extends BaseEntity
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
    ];

    protected static function booted()
    {
        parent::booted();
        static::creating(function ($model) {
            if ($model->slug === null || $model->slug === '') {
                $model->slug = Str::slug($model->name) . '-' . Str::random(4);
            }
        });
    }
}
