<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use App\Entities\Course;
use App\Helpers\Statics\CourseStatusStatic;

class CourseService {

    public function create($request)
    {
        $data = $request->all();
        $data['teacher_id'] = auth()->id(); 
        $data['status'] = CourseStatusStatic::UNPUBLISHED;
        $data['lp_complete_bonus'] = $data['tuition_fee'] > 100 ? $data['tuition_fee'] : 100; 
        $course = Course::create($data);

        return response()
            ->json($course); 
    }
}



?>