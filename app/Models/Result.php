<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ad_item_id',
    ];

    protected $casts = [
        'ad_item_id' => 'integer',
    ];

    public function adItem(): BelongsTo
    {
        return $this->belongsTo(AdItem::class);
    }
}
