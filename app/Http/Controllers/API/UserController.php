<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\IUserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    private IUserRepositoryInterface $userRepository;

    public function __construct(IUserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
}
