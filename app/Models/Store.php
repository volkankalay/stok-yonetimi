<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $owner_id
 * @property string $name
 */
class Store extends Model
{
    use HasFactory, SoftDeletes;

    /** @inheritdoc */
    protected $table = 'stores';

    /** @inheritdoc */
    protected $fillable = [
        'owner_id',
        'name'
    ];

    protected $attributes = [
        'owner_id' => ['integer', 'exists:' . User::class . ',id'],
        'name' => ['string']
    ];

    protected $casts = [
        'owner_id' => ['required'],
        'name' => ['required'],
    ];

    /**
     * @return HasOne
     */
    public function owner(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }
}
