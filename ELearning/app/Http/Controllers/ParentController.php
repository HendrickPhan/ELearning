<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterParentRequest;
use App\Http\Services\ParentService;

class ParentController extends Controller
{
    //
    public function __construct(ParentService $parentService)
    {
        $this->service = $parentService;
    }

    public function register(RegisterParentRequest $request)
    {
        return $this->service->register($request);
    }

    public function info()
    {
        return $this->service->info();
    }

}
