<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\UserRequest;
use App\Interfaces\IAdminRepositoryInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private IAdminRepositoryInterface $adminRepository;
    private $responseApi;

    public function __construct(IAdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->responseApi = new ResponseApi();
    }

    public function index()
    {
        try {

            $data = $this->adminRepository->getAllAdmin();

            if (count($data) > 0) {
                return $this->responseApi->success("All Admins", $data);
            } else {
                return [];
            }

        } catch (\Exception $exception) {
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function show(int $adminId)
    {
        try {

            $admin = $this->adminRepository->getAdminById($adminId);

            if ($admin){
                return $this->responseApi->success("$admin->name", $category);
            } else {
                return $this->responseApi->error("No Admin with ID $adminId", 404);
            }

        } catch (\Exception $exception){
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function store(AdminRequest $request)
    {
        try {

            $store = $this->adminRepository->createAdmin($request);

            if ($store) {
                return $this->responseApi->success("$request->name created", $store);
            } else {
                return $this->responseApi->error("Error");
            }

        } catch (\Exception $exception) {
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function loginUser(UserRequest $request)
    {
        return $this->adminRepository->loginUser($request);
    }
}
