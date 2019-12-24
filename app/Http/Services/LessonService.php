<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use App\Entities\Lesson;
use App\Entities\QuizAttempt;
use DateTime;

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
        $lesson = Lesson::find($request->id);
        $lesson->update($data);

        return response()
            ->json($lesson);
    }

    public function delete($id)
    {
        $lesson = Lesson::find($id);
        $lesson->delete();

        return response()
            ->json('Success');
    }

    public function mySelectList()
    {
        $lessons = Lesson::select('id', 'name')
            ->where('created_by', auth()->id())
            ->get();
            
        return response()
            ->json($lessons);
    }

    public function learnLesson($request)
    {
        $lessonId = $request->lesson_id;
        $course = auth()->user()->enrolledCourse()
            ->with([
                'lessons' => function ($q) use ($lessonId) {
                    $q->where('lesson_id', $lessonId)
                    ->where('start_at', '<=', new DateTime())
                    ->where('end_at', '>=', new DateTime());
                }
            ])
            ->where('course_id', $request->course_id)
            ->first();

        $lesson = isset($course->lessons[0]) ? $course->lessons[0] : null;
        if (!$lesson) {
            return response()
                ->json('Không tìm thấy bài học', 422); 
        }

        $quizAttempt = QuizAttempt::where('user_id', auth()->id())
            ->where('lesson_id', $lesson->id)
            ->where('course_id', $course->id)
            ->get();
        
        $lesson->quiz_attempt = $quizAttempt;  
        
        return response()
            ->json( $lesson );
    }

}

?>