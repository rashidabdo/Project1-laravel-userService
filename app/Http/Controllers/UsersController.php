<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class UsersController extends Controller
{
    private $userService;

    /**
     * @param UserService $userService
     */
    public   function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->userService->getActiveAustriaUser();
    }

    /**
     * @param $userId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function editUser($userId)
    {
        return $this->userService->editUser($userId);
    }

    /**
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUser($userId)
    {
        return $this->userService->deleteUser($userId);
    }
}
