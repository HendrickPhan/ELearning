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

    public function search()
    {
        return $this->service->search();
    }
    
}
