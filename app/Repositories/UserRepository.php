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
        return User::all();
    }

    public function getUserById($userId)
    {
        return User::findOrFail($userId);
    }

    public function createUser($request)
    {
        $user = new User();

        $user->name          = $request->name;
        $user->email         = $request->email;
        $user->password      = Hash::make($request->password);
        $user->gender        = $request->gender;
        $user->phone         = $request->phone;
        $user->last_login    = date('Y-m-d H:i:s');

        $user->save();

        $token = $user->createToken('API Token')->plainTextToken;

        $userInfo = [$user, $token];

        if ($user->save()){
            return $userInfo;
        } else {
            return null;
        }
    }

    public function updateUser($request, $userId)
    {
        $user = User::findOrFail($userId);

        $user->name          = $request->name;
        $user->email         = $request->email;
        $user->password      = Hash::make($request->password);
        $user->gender        = $request->gender;
        $user->phone         = $request->phone;
        $user->last_login    = date('Y-m-d H:i:s');

        $user->save();

        if ($user->save()){
            return $user;
        } else {
            return null;
        }
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);

        if (!$user){
            return $this->error("No User with ID $userId", 404);
        }

        $user->delete();

        return $this->success("User Deleted", $user);
    }

    public function loginUser($request)
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
