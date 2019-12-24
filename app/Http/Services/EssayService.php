<?php

namespace App\Http\Services;

use App\Entities\Essay;
use Illuminate\Support\Facades\Request;

class EssayService {

    public function create($request)
    {
        $data = $request->all();
        $user = auth()->user();

        //create quiz
        $essay = $user->essays()
            ->create([
                'name' => $data['name']
            ]);
        //create quiz question
        foreach($data['questions'] as $question){
            $essayQuestion = $essay->essayQuestions()
                ->create([
                    'question' => $question['question'],
                    'point' => $question['point'],
                ]);
        } 
        return response()
            ->json($essay);
    }


    public function mySelectList()
    {
        $essays = Essay::select('id', 'name')
            ->where('created_by', auth()->id())
            ->get();
            
        return response()
            ->json($essays);
    }
}