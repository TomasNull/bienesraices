<?php

namespace App\Policies;

use App\RealEstate;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstatePolicy
{
    use HandlesAuthorization;

    public function follow_estate (User $user, RealEstate $estate) {
        return ! $user->agent || $user->agent->id !== $estate->agent_id;
    }

    public function inscribed (User $user, RealEstate $estate) {
        return ! $estate->clients->contains($user->client->id);
    }

    public function review (User $user, RealEstate $estate) {
        return ! $estate->reviews->contains('user_id', $user->id);
    }

}
