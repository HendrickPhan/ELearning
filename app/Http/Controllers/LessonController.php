<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateLessonRequest;
use App\Http\Services\LessonService;

class LessonController extends Controller
{
    //
    protected $service;

    public function __construct(LessonService $lessonService)
    {
        $this->service = $lessonService;
    }

    public function create(CreateLessonRequest $request) 
    {
        return $this->service->create($request);
    }

    public function detail($id)
    {
        return $this->service->detail($id);
    } 
}
