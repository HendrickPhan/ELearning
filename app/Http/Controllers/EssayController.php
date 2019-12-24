<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateEssayRequest;
use App\Http\Services\EssayService;

class EssayController extends Controller
{
    //
    protected $service;

    public function __construct(EssayService $essayService)
    {
        $this->service = $essayService;
    }

    public function create(CreateEssayRequest $request)
    {
        return $this->service->create($request); 
    }

    public function mySelectList()
    {
        return $this->service->mySelectList(); 
    }
}
