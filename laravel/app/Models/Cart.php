<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    protected $table = 'carrinhos';

    protected $fillable = [
        'usuario_id',
        'total',
        'status',
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'total' => 'float',
    ];

    /**
     * Relacionamento com usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Relacionamento com produtos através da tabela pivot
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'carrinho_produtos', 'carrinho_id', 'produto_id')
                    ->withPivot('quantidade', 'preco_unitario')
                    ->withTimestamps();
    }

    /**
     * Calcula o total do carrinho
     */
    public function calculateTotal()
    {
        return $this->products()->sum(DB::raw('quantidade * preco_unitario'));
    }
}
