<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'price',
        'subtotal',
    ];

    public function menu(): BelongsTo {
        return $this->belongsTo(Menu::class);
    }

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class);
    }
}
