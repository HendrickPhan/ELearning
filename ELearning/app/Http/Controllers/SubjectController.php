<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\SubjectService;
use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;

class SubjectController extends Controller
{
    //
    protected $service;

    public function __construct(SubjectService $subjectService)
    {
        $this->service = $subjectService;    
    }
    
    public function index(Request $request)
    {
        return $this->service->index($request); 
    }

    public function detail($id)
    {
        return $this->service->detail($id);
    }

    public function create(CreateSubjectRequest $request)
    {
        return $this->service->create($request);
    }

    public function update(UpdateSubjectRequest $request)
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
