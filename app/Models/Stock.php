<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $owner_id
 * @property int $store_id
 * @property string $name
 * @property string $unit
 * @property float $stock_amount
 */
class Stock extends Model
{
    use HasFactory, SoftDeletes;

    /** @inheritdoc */
    protected $table = 'stocks';

    /** @inheritdoc */
    protected $fillable = [
        'owner_id',
        'store_id',
        'name',
        'unit',
        'stock_amount',
    ];

    protected $attributes = [
        'owner_id' => ['integer', 'exists:' . User::class . ',id'],
        'store_id' => ['integer', 'exists:' . Store::class . ',id'],
        'name' => ['string'],
        'unit' => ['string'],
        'stock_amount' => ['numeric']
    ];

    protected $casts = [
        'owner_id' => ['required'],
        'name' => ['required'],
        'unit' => ['required'],
    ];

    /**
     * @return void
     */
    protected static function boot(): void
    {
        static::deleted(function ($model) {
            $model->histories()->each(function ($item) {
                $item->delete();
            });
        });

        parent::boot();
    }

    /**
     * @return HasMany
     */
    public function histories(): HasMany
    {
        return $this->hasMany(StockHistory::class, 'stock_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function store(): HasOne
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }
}
