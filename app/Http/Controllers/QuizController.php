<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateQuizRequest;
use App\Http\Services\QuizService;

class QuizController extends Controller
{
    //
    protected $service;

    public function __construct(QuizService $quizService)
    {
        $this->service = $quizService;
    }

    public function create(CreateQuizRequest $request)
    {
        return $this->service->create($request); 
    }

    public function mySelectList()
    {
        return $this->service->mySelectList(); 
    }

    public function doQuiz(Request $request)
    {
        return $this->service->doQuiz($request); 
    }

}
