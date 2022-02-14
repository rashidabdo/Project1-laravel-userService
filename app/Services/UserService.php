<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;

class UserService
{
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get list of active user that Austrian citizenship.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getActiveAustriaUser()
    {
        $this->user = User::with('details', 'country')
            ->whereHas('country', function ($query) {
                $query->where('name', 'like', '%Austria%');
            })
            ->where('active', '=', '1')
            ->get();

        return UserResource::collection($this->user);
    }

    /**
     * Edit user that has details.
     * @param $userId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function editUser($userId)
    {
        $this->user = User::with('details')
            ->where('id', '=', $userId)
            ->wherehas('details')
            ->get();

        return UserResource::collection($this->user);
    }

    /** Delete user that does not have details.
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUser($userId)
    {
        $this->user = User::where('id', '=', $userId)->first();
        if ($this->user == null) {
            return response()->json('User not existed in system!');
        }
        if ($this->user->details == null) {
            $this->user->delete();
            return response()->json('User deleted.');
        } else {
            return response()->json('User has details not possible to delete it.');
        }
    }
}
