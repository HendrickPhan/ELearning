<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\GradeService;
use App\Http\Requests\CreateGradeRequest;
use App\Http\Requests\UpdateGradeRequest;

class GradeController extends Controller
{
    //
    protected $service;

    public function __construct(GradeService $gradeService)
    {
        $this->service = $gradeService;    
    }
    
    public function index(Request $request)
    {
        return $this->service->index($request); 
    }

    public function detail($id)
    {
        return $this->service->detail($id);
    }

    public function create(CreateGradeRequest $request)
    {
        return $this->service->create($request);
    }

    public function update(UpdateGradeRequest $request)
    {
        return $this->service->update($request);
    }

    public function updateStatus(Request $request)
    {
       return $this->service->updateStatus($request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }
}
