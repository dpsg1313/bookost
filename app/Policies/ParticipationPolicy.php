<?php

namespace App\Policies;

use App\Models\Participation;
use App\Models\Responsibility;
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

    /**
     * Determine whether the user can sign the model.
     *
     * @param User $user
     * @param Participation $participation
     * @return bool
     */
    public function sign(User $user, Participation $participation): bool
    {
        if(Responsibility::query()->where('user_id', $user->id)->where('group', $participation->stamm)->exists()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can pay the model.
     *
     * @param User $user
     * @param Participation $participation
     * @return bool
     */
    public function pay(User $user, Participation $participation): bool
    {
        if(Responsibility::query()->where('user_id', $user->id)->where('group', $participation->stamm)->exists()){
            return true;
        }
        return false;
    }
}
