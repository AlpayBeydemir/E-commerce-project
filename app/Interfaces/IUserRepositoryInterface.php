<?php

namespace App\Interfaces;

use App\Models\User;

interface IUserRepositoryInterface{

    public function getAllUsers();

    public function getUserById($userId);

    public function createUser(User $request);

    public function updateUser(User $request ,$userId);

    public function deleteUser($userId);

    public function loginUser(User $request);
}
