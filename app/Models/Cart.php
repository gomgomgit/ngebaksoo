<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'menu_id',
        'quantity',
        'notes'
    ];

    public function menu(): BelongsTo {
        return $this->belongsTo(Menu::class);
    }
}
