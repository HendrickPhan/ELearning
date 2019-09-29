<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AttachCertificatesRequest;
use App\Http\Requests\AttachGradeSubjectsRequest;
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

    public function attachCertificates(AttachCertificatesRequest $request)
    {
        return $this->service->attachCertificates($request);
    }

    public function attachGradeSubjects(AttachGradeSubjectsRequest $request)
    {
        return $this->service->attachGradeSubjects($request);
    }

    public function detail($id) //detail is public info that every one can view
    {
        return $this->service->detail($id);
    }

    public function info() //only teacher can view his info
    {
        return $this->service->info();
    }
}
