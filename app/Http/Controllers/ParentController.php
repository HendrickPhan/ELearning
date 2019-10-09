<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterParentRequest;
use App\Http\Requests\UpdateParentInformationRequest;
use App\Http\Services\ParentService;

class ParentController extends Controller
{
    //
    public function __construct(ParentService $parentService)
    {
        $this->service = $parentService;
    }

    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    public function register(RegisterParentRequest $request)
    {
        return $this->service->register($request);
    }

    public function info() //only parent can view his info
    {
        return $this->service->info();
    }

    public function detail($id) //detail is public info that every one can view
    {
        return $this->service->detail($id);
    }

    public function updateInformation(UpdateParentInformationRequest $request)
    {
        return $this->service->update($request);
    }

}
