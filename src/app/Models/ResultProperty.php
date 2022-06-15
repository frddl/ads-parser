<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResultProperty extends Model
{
    protected $fillable = [
        'result_id',
        'data'
    ];

    protected $casts = [
        'data' => 'json'
    ];

    public function result(): BelongsTo
    {
        return $this->belongsTo(Result::class);
    }
}
