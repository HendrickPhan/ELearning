<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterStudentRequest;
use App\Http\Services\StudentService;


class StudentController extends Controller
{
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

    public function approve(Request $request)
    {
        return $this->service->approve($request);
    }

    public function reject(Request $request)
    {
        return $this->service->reject($request);
    }

    public function parentList()
    {
        return $this->service->parentList();
    }

    public function searchTeacher(Request $request)
    {
        return $this->service->searchTeacher($request);
    }

    public function detailTeacher($id)
    {
        return $this->service->detailTeacher($id);
    }
    
    public function subscribeTeacher($id)
    {
        return $this->service->subscribeTeacher($id);
    }
    
}
