<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockHistory extends Model
{
    use HasFactory, SoftDeletes;

    /** @inheritdoc */
    protected $table = 'stock_histories';

    /** @inheritdoc */
    protected $fillable = [
        'owner_id',
        'store_id',
        'stock_id',
        'direction',
        'change',
    ];

    protected $attributes = [
        'owner_id' => ['integer', 'exists:' . User::class . ',id'],
        'store_id' => ['integer', 'exists:' . Store::class . ',id'],
        'stock_id' => ['integer', 'exists:' . Stock::class . ',id'],
        'direction' => ['integer'],
        'change' => ['numeric']
    ];

    protected $casts = [
        'owner_id' => ['required'],
        'store_id' => ['required'],
        'stock_id' => ['required'],
        'direction' => ['required'],
        'change' => ['required'],
    ];
}
