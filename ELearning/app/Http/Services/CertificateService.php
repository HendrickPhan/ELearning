<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use App\Entities\Certificate;
use App\Helpers\Statics\CertificateStatusStatic;

class CertificateService {

    public function create($request)
    {
        $user = Auth::user();
        $data = $request->all();
        // $data['created_by'] = $user->id; 
        $data['created_by'] = 1; 
        $data['status'] = CertificateStatusStatic::NOT_FEATURED;

        $certificate = Certificate::create($data);

        return response()
            ->json($certificate); 
    }
}



?>