<?php

namespace App\Repositories;

use App\Http\Requests\AdminRequest;
use App\Interfaces\IAdminRepositoryInterface;
use App\Models\AdminModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminRepository implements IAdminRepositoryInterface
{

    public function getAllAdmin()
    {
        return AdminModel::all();
    }

    public function getAdminById(int $adminId)
    {
        return AdminModel::find($adminId);
    }

    public function createAdmin($request)
    {
        $admin = new AdminModel();

        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->last_login = $request->last_login;

        $admin->save();

        $token = $admin->createToken('API Token')->plainTextToken;

        $adminInfo = [$admin, $token];

        if ($admin->save()){
            return $adminInfo;
        } else {
            return null;
        }
    }

    public function updateAdmin($request, int $adminId)
    {
        $admin = AdminModel::findOrFail($adminId);

        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->last_login = $request->last_login;

        $admin->save();

        if ($admin->save()){
            return $admin;
        } else {
            return null;
        }
    }

    public function deleteAdmin(int $adminId)
    {
        $admin = AdminModel::findOrFail($adminId);

        $admin->deleted = 1;
        $admin->deleted_at = date('Y-m-d H:i:s');

        $admin->save();

        if ($admin->save()){
            return $admin;
        } else {
            return null;
        }
    }

    public function loginAdmin($admin)
    {
        try {

            if (!Auth::attempt($admin->only(['email', 'password']))){
                return $this->error("Email & Password does not match with our record", 404);
            }

            $user = AdminModel::where('email', $admin->email)->first();
            return $this->success("User Logged In Successfuly", $user->createToken('API Token')->plainTextToken);

        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
