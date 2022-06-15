<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ad_item_id',
        'result_link'
    ];

    protected $casts = [
        'ad_item_id' => 'integer',
    ];

    protected $with = ['adItem', 'property'];

    public function adItem(): BelongsTo
    {
        return $this->belongsTo(AdItem::class);
    }

    public function property(): HasOne
    {
        return $this->hasOne(ResultProperty::class);
    }
}
