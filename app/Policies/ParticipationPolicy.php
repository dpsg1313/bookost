<?php

namespace App\Policies;

use App\Models\Participation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParticipationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Participation $participation
     * @return bool
     */
    public function edit(User $user, Participation $participation): bool
    {
        if($participation->user->id == $user->id) {
            return true;
        }
        return false;
    }
}
