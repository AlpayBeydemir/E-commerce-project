<?php

namespace App\Interfaces;

use App\Models\AdminModel;

interface IAdminRepositoryInterface
{
    public function getAllAdmin();

    public function getAdminById(int $adminId);

    public function createAdmin(AdminModel $admin);

    public function updateAdmin(AdminModel $admin ,int $adminId);

    public function deleteAdmin(int $adminId);

    public function loginAdmin(AdminModel $admin);
}
