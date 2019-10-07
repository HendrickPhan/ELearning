<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\SubscribeStudentService;
use App\Http\Requests\SubscribeStudentRequest;


class SubscribeStudentController extends Controller
{
    //
    public function __construct(SubscribeStudentService $subscribeStudentService)
    {
        $this->service = $subscribeStudentService;
    }
    public function subscribeStudent(SubscribeStudentRequest $request)
    {
        return $this->service->subscribeStudent($request->id);
    }
}
