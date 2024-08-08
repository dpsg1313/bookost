<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Builder
 */
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
        'bus_there' => 'boolean',
        'bus_back' => 'boolean',
    ];

    public function isSigned() {
        return !is_null($this->signed_at);
    }
    public function isPaid() {
        return !is_null($this->paid_at);
    }

    public function apply() {
        $this->applied_at = now();
    }

    public function sign() {
        $this->signed_at = now();
    }

    public function unsign() {
        $this->signed_at = null;
    }

    public function pay() {
        $this->paid_at = now();
    }

    public function unpay() {
        $this->paid_at = null;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
