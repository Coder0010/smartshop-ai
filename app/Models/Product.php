<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use MkamelMasoud\StarterCoreKit\Core\BaseEntity;

/**
 * @property int $id
 * @property string $slug
 * @property string|null $name_en
 * @property string|null $name_ar
 * @property string|null $description_en
 * @property string|null $description_ar
 * @property string|null $image
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @mixin \Eloquent
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

    public function getImageAttribute(?string $value): string
    {
        if ($value === null || trim($value) === '') {
            return 'https://fastly.picsum.photos/id/1074/400/400.jpg?hmac=eH9O4qH8NQGitzB3QaCq9jrbDZr7KQkaW_w17w0uoGM';
        }
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }
        if (Storage::disk('public')->exists($value)) {
            return asset('storage/' . ltrim($value, '/'));
        }

        return 'https://fastly.picsum.photos/id/1074/400/400.jpg?hmac=eH9O4qH8NQGitzB3QaCq9jrbDZr7KQkaW_w17w0uoGM';
    }
}
