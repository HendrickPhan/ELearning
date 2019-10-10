<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use App\Entities\Lesson;

class LessonService {

    public function index($request)
    {
        // 
    }

    public function detail($id)
    {
        $lesson = find($id);
        return response()
            ->json($lesson);
    }

    public function create($request)
    {
        $data = $request->all();
        $user = auth()->user();
        $lesson = $user->lessons()
            ->create($data);

        return response()
            ->json($lesson);
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