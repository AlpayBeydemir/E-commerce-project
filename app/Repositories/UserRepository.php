<?php

namespace App\Repositories;

use App\Interfaces\IUserRepositoryInterface;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Symfony\Component\String\u;

class UserRepository implements IUserRepositoryInterface
{
    use ResponseAPI;

    public function getAllUsers()
    {
        try {
            $users = User::all();
            return $this->success("All Users", $users);
        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getUserById($userId)
    {
        try {
            $user = User::findOrFail($userId);

            if (!$user){
                return $this->error("No User with ID $userId", 404);
            }

            return $this->success("User Detail", $user);
        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function createUser(UserRequest $request)
    {
        try {

            $user = new User();

            $user->name          = $request->name;
            $user->email         = $request->email;
            $user->password      = Hash::make($request->password);
            $user->gender        = $request->gender;
            $user->phone         = $request->phone;
            $user->last_login    = date('Y-m-d H:i:s');

            $user->save();

            $token = $user->createToken('API Token')->plainTextToken;

            return $this->success("$user->name created", [
                'user'  => $user,
                'token' => $token
            ]);

        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function updateUser(UserRequest $request, $userId)
    {
        try {

            $user = User::findOrFail($userId);

            if (!$user){
                return $this->error("No User with ID $userId", 404);
            }

            $user->name          = $request->name;
            $user->email         = $request->email;
            $user->password      = Hash::make($request->password);
            $user->gender        = $request->gender;
            $user->phone         = $request->phone;
            $user->last_login    = date('Y-m-d H:i:s');

            $user->save();

            return $this->success("$user->name updated", $user);

        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function deleteUser($userId)
    {
        try {

            $user = User::findOrFail($userId);

            if (!$user){
                return $this->error("No User with ID $userId", 404);
            }

            $user->delete();

            return $this->success("User Deleted", $user);

        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function loginUser(UserRequest $request)
    {
        try {

            if (!Auth::attempt($request->only(['email', 'password']))){
                return $this->error("Email & Password does not match with our record", 404);
            }

            $user = User::where('email', $request->email)->first();
            return $this->success("User Logged In Successfuly", $user->createToken('API Token')->plainTextToken);

        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }

    }
}
