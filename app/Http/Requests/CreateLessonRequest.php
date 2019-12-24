<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CreateLessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        $userId = auth()->id();   

        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'video' => 'required|string',
            'quiz_id' => [
                'required',
                Rule::exists('quizs', 'id')                     
                ->where(function ($query) use ($userId) {                      
                    $query->where('created_by', $userId);                  
                }),            
            ],
            'essay_id' => 'required|exists:essays,id',
        ];
    }
}
