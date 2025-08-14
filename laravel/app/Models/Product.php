<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'categoria_id',
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'preco' => 'float',
    ];

    /**
     * Relacionamento com categoria
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoria_id');
    }

    /**
     * Relacionamento com carrinho através da tabela pivot
     */
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'carrinho_produtos', 'produto_id', 'carrinho_id')
                    ->withPivot('quantidade', 'preco_unitario')
                    ->withTimestamps();
    }
}
