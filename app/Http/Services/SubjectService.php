<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use App\Helpers\Statics\GeneralStatusStatic;
use App\Entities\Subject;

class SubjectService {

    public function index()
    {
        $subjects = Subject::all();

        return response()
            ->json($subjects); 

    }

    public function paginate($request)
    {
        $limit = $request->get('limit', 10);
        $status = $request->get('status', null);

        $subjectsQuery = Subject::query();

        if ($status) {
            $subjectsQuery = $subjectsQuery->where('status', $status);
        }

        $subjectsResult = $subjectsQuery->paginate($limit);

        return response()
            ->json($subjectsResult); 

    }

    public function detail($id)
    {
        $subject = Subject::find($id);

        return response()
            ->json($subject);
    }

    public function create($request)
    {
        $data = $request->all();
        $data['status'] = GeneralStatusStatic::UNPUBLISHED;
        $subject = Subject::create($data);

        return response()
            ->json($subject);
    }

    public function update($request)
    {
        $data = $request->all();
        $subject = Subject::find($request->id);
        $subject->update($data);

        return response()
            ->json($subject);
    }

    public function delete($id)
    {
        $subject = Subject::find($id);
        $subject->delete();

        return response()
            ->json('Success');
    }
}

?>