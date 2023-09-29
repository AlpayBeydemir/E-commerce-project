<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseApi;
use App\Http\Controllers\Controller;
use App\Interfaces\IUserRepositoryInterface;
use App\Http\Requests\UserRequest;
use App\Models\User;
use function Symfony\Component\String\s;

class UserController extends Controller
{
    private IUserRepositoryInterface $userRepository;
    private $responseApi;

    public function __construct(IUserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->responseApi = new ResponseApi();
    }

    public function index()
    {
        try {

            $data = $this->userRepository->getAllUsers();

            if (count($data) > 0) {
                return $this->responseApi->success("All Users", $data);
            } else {
                return [];
            }

        } catch (\Exception $exception) {
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function store(UserRequest $request)
    {
        try {

            $store = $this->userRepository->createUser($request);

            if ($store) {
                return $this->responseApi->success("$request->name created", $store);
            } else {
                return $this->responseApi->error("Error");
            }

        } catch (\Exception $exception) {
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function show(string $id)
    {
        try {

            $user = $this->userRepository->getUserById($id);

            if ($user) {
                return $this->responseApi->success("$user->name", $user);
            } else {
                return $this->responseApi->error("No User with ID $id", 404);
            }

        } catch (\Exception $exception) {
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function update(UserRequest $request, string $id)
    {
        try {

            $update = $this->userRepository->updateUser($request, $id);

            if ($update) {
                return $this->responseApi->success("User Updated", $update);
            } else {
                return $this->responseApi->error("Error");
            }

        } catch (\Exception $exception) {
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function destroy(string $id)
    {
        try {

            $destroy = $this->userRepository->deleteUser($id);

            if ($destroy) {
                return $this->responseApi->success("User Deleted", $destroy);
            } else {
                return $this->responseApi->error("Error");
            }

        } catch (\Exception $exception){
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function loginUser(UserRequest $request)
    {
        return $this->userRepository->loginUser($request);
    }

}

