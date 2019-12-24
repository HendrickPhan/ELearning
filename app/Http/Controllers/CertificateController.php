<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCerficateRequest;
use App\Http\Services\CertificateService;

class CertificateController extends Controller
{
    //
    protected $service;

    public function __construct(CertificateService $certificateService)
    {
        $this->service = $certificateService;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function create(CreateCerficateRequest $request)
    {
        return $this->service->create($request);
    }
}
