<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterStudentRequest;
use App\Http\Requests\SubscribeStudentRequest;
use App\Http\Services\StudentService;

class StudentController extends Controller
{
    protected $service;
    //
    public function __construct(StudentService $studentService)
    {
        $this->service = $studentService;
    }

    public function register(RegisterStudentRequest $request)
    {
        return $this->service->register($request);
    }

    public function info()
    {
        return $this->service->info();
    }

    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    public function detail($id)
    {
        return $this->service->detail($id);
    }

    public function subscribeStudent(SubscribeStudentRequest $request)
    {
        return $this->service->subscribeStudent($request->id);
    }

    public function approveParentSubscribe($id)
    {
        return $this->service->approveParentSubscribe($id);
    }

    public function rejectParentSubscribe($id)
    {
        return $this->service->rejectParentSubscribe($id);
    }

    public function subscribedParentList(Request $request)
    {
        return $this->service->subscribedParentList($request);
    }
}
