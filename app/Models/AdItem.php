<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'keyword',
        'price_min',
        'price_max',
        'provider',
        'blacklisted',
        'minutes',
        'is_active'
    ];

    protected $casts = [
        'price_min' => 'integer',
        'price_max' => 'integer',
        'provider'  => 'integer',
        'minutes'   => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class)->orderByDesc('id');
    }
}
