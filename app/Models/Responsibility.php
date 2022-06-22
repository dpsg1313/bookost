<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Responsibility extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'readonly' => 'boolean',
    ];

    public function apply() {
        $this->applied_at = now();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
