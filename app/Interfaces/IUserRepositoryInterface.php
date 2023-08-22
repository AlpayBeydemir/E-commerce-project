<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;

interface IUserRepositoryInterface{

    public function getAllUsers();

    public function getUserById($userId);

    public function createUser(UserRequest $request);

    public function updateUser(UserRequest $request ,$userId);

    public function deleteUser($userId);

    public function loginUser(UserRequest $request);
}
