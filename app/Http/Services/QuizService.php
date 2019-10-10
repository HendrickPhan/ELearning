<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;

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
}