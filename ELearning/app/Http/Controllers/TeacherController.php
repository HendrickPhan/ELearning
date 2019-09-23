<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterTeacherRequest;
use App\Http\Services\TeacherService;

class TeacherController extends Controller
{
    //
    protected $service;

    public function __construct(TeacherService $teacherService)
    {
        $this->service = $teacherService;
    }

    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    public function register(RegisterTeacherRequest $request)
    {
        return $this->service->register($request);
    }

    public function detail($id)
    {
        return $this->service->detail($id);
    }
    public function info()
    {
        return $this->service->info();
    }

}
