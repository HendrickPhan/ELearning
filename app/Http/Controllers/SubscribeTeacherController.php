<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\SubscribeTeacherService;
use App\Http\Requests\SubscribeTeacherRequest;


class SubscribeTeacherController extends Controller
{
    //
    public function __construct(SubscribeTeacherService $subscribeTeacherService)
    {
        $this->service = $subscribeTeacherService;
    }
    public function subscribeTeacher(SubscribeTeacherRequest $request)
    {
        return $this->service->subscribeTeacher($request->id);
    }
}
