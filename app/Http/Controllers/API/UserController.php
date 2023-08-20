<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\IUserRepositoryInterface;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    private IUserRepositoryInterface $userRepository;

    public function __construct(IUserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return $this->userRepository->getAllUsers();
    }

    public function store(UserRequest $request)
    {
        return $this->userRepository->createUser($request);
    }

    public function show(string $id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function update(UserRequest $request, string $id)
    {
        return $this->userRepository->updateUser($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->userRepository->deleteUser($id);
    }
}

