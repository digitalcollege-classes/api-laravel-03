<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertiser_id',
        'product_id',
        'title',
        'description',
        'price',
        'status',
        'published_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'id';
    }

    // RELACIONAMENTOS
    /**
     * Um anúncio pertence a um produto
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relacionamento indireto: categoria através do produto
     */
    public function category()
    {
        return $this->hasOneThrough(Category::class, Product::class, 'id', 'id', 'product_id', 'category_id');
    }

    // MÉTODOS DE STATUS
    public function activate(): void
    {
        $this->update(['status' => 'active']);
    }

    public function pause(): void
    {
        $this->update(['status' => 'paused']);
    }

    public function markAsSold(): void
    {
        $this->update(['status' => 'sold']);
    }

    public function deactivate(): void
    {
        $this->update(['status' => 'inactive']);
    }

    public function publish(): void
    {
        $this->update([
            'status' => 'active',
            'published_at' => now()
        ]);
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isSold(): bool
    {
        return $this->status === 'sold';
    }

    // SCOPES
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function scopeByAdvertiser($query, $advertiserId)
    {
        return $query->where('advertiser_id', $advertiserId);
    }

    public function scopePriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    public function scopeWithProduct($query)
    {
        return $query->with('product');
    }

    public function scopeWithProductAndCategory($query)
    {
        return $query->with(['product', 'product.category']);
    }
}