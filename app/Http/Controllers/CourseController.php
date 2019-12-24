<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Services\CourseService;

class CourseController extends Controller
{
    //
    protected $service;

    public function __construct(CourseService $courseService)
    {
        $this->service = $courseService;
    }

    public function create(CreateCourseRequest $request)
    {
        return $this->service->create($request);
    }

    public function recommend(Request $request)
    {
        return $this->service->recommend($request);
    }


    public function studentMyCourses(Request $request)
    {
        return $this->service->studentMyCourses($request);
    }

    public function detail($id)
    {
        return $this->service->detail($id);
    }

    public function enroll($id)
    {
        return $this->service->enroll($id);
    }

    public function studentIndex(Request $request)
    {
        return $this->service->studentIndex($request);
    }

    public function addComment(Request $request) 
    {
        return $this->service->addComment($request); 
    }
}
