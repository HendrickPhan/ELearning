<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Entities\Quiz;
use App\Entities\QuizAttempt;
use App\Entities\QuizQuestion;
use App\Entities\QuizQuestionAnswer;
use DB;

class QuizAttemptController extends Controller
{
 
    public function attempt(Request $request)
    {
        $data = $request->all();
        $attemptPoint = 0;
        $quiz = Quiz::find($data['quiz_id']);
        $totalPoint = $quiz->quizQuestions()->sum('point'); 
        foreach($data['answers'] as &$answerDetail) {
            $answer = QuizQuestionAnswer::find($answerDetail['answer_id']);
            $question = QuizQuestion::find($answerDetail['question_id']);
            if ($answer->quiz_question_id != $question->id) {
                return response()
                    ->json('Câu trả lời không hợp lệ', 422); 
            }

            if($answer->is_right) {
                $attemptPoint += $question->point;
            }

            $answerDetail['is_correct'] = $answer->is_right;
        } 

        $quizAttempt = QuizAttempt::create([
            'course_id' => $request->course_id,
            'lesson_id' => $request->lesson_id,
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'point' => $attemptPoint,
            'total_point' => $totalPoint,
        ]);

        $quizAttempt->details()->createMany($data['answers']);
        
        return response()
                ->json($quizAttempt); 
    }

}
