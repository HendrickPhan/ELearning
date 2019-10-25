<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\AdminService;

class AdminController extends Controller
{
    //
    protected $service;
    
    public function __construct(AdminService $adminService)
    {
        $this->service = $adminService;
    }

    public function activateUser($userId)
    {
        return $this->service->activateUser($userId);
    }

    public function deactivateUser($userId)
    {
        return $this->service->deactivateUser($userId);
    }
    
}
