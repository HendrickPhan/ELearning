<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use App\Entities\Quiz;
use DateTime;

class QuizService {

    public function create($request)
    {
        $data = $request->all();
        $user = auth()->user();

        //create quiz
        $quiz = $user->quizs()
            ->create([
                'name' => $data['name']
            ]);
        //create quiz question
        foreach($data['questions'] as $question){
            $quizQuestion = $quiz->quizQuestions()
                ->create([
                    'question' => $question['question'],
                    'point' => $question['point'],
                ]);
            //create quiz answer
            foreach($question['answers'] as $answer) {
                $quizQuestion->quizQuestionAnswers()
                    ->create([
                        'answer' => $answer['answer'],
                        'is_right' => $answer['is_right'],
                    ]);
            }
        } 
        return response()
            ->json($quiz);
    }

    public function mySelectList()
    {
        $quizs = Quiz::select('id', 'name')
            ->where('created_by', auth()->id())
            ->get();
            
        return response()
            ->json($quizs);
    }

    public function doQuiz($request)
    {
        $lessonId = $request->lesson_id;
        $course = auth()->user()->enrolledCourse()
            ->with([
                'lessons' => function ($q) use ($lessonId) {
                    $q->with('quiz.quizQuestions.quizQuestionAnswers')
                    ->where('lesson_id', $lessonId)
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

        $quiz = $lesson->quiz; 

        return response()
            ->json( $quiz );
    }
}