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
        'start_url',
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
        'minutes'   => 'integer',
        'is_active' => 'boolean',
    ];

    // ->active()
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ->every(15)
    public function scopeEvery($query, $minutes)
    {
        return $query->where('minutes', $minutes);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class)->orderByDesc('id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($adItem) { // before delete() method call this
            $adItem->results()->delete();
            // do the rest of the cleanup...
        });
    }
}
