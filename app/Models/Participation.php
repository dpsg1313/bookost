<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participation extends Model
{
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'prevention' => 'boolean',
        'vaccination_info_confirmed' => 'boolean',
        'foto_consent_confirmed' => 'boolean',
        'gluten' => 'boolean',
        'lactose' => 'boolean',
    ];

    public function apply() {
        $this->applied_at = now();
    }

    public function sign() {
        $this->signed_at = now();
    }

    public function pay() {
        $this->paid_at = now();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
