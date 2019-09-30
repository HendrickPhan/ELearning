<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Helpers\Statics\GeneralStatusStatic;
use App\Entities\Grade;

class GradeService {

    public function index($request)
    {
        $limit = $request->get('limit', 10);
        $status = $request->get('status', null);

        $gradesQuery = Grade::query();

        if ($status) {
            $gradesQuery = $gradesQuery->where('status', $status);
        }

        $gradesResult = $gradesQuery->paginate($limit);

        return response()
            ->json($gradesResult); 
    }

    public function detail($id)
    {
        $grade = Grade::find($id);

        return response()
            ->json($grade);
    }

    public function create($request)
    {
        $data = $request->all();
        $data['status'] = GeneralStatusStatic::UNPUBLISHED;
        $grade = Grade::create($data);

        return response()
            ->json($grade);
    }

    public function update($request)
    {
        $data = $request->all();
        $grade = Grade::find($request->id);
        $grade->update($data);

        return response()
            ->json($grade);
    }

    public function delete($id)
    {
        $grade = Grade::find($id);
        $grade->delete();

        return response()
            ->json('Success');
    }
}



?>