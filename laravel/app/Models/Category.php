<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_path',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'id';
    }

    // RELACIONAMENTOS
    /**
     * Uma categoria tem muitos produtos
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Uma categoria tem muitos anúncios (através dos produtos)
     */
    public function advertisements(): HasMany
    {
        return $this->hasManyThrough(Advertisement::class, Product::class);
    }

    // SCOPES
    public function scopeWithProducts($query)
    {
        return $query->with('products');
    }

    public function scopeActive($query)
    {
        return $query->whereHas('products', function ($q) {
            $q->where('is_active', true);
        });
    }
}
