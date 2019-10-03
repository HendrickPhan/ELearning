<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
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
        return [
            'title' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'grade_id' => 'required|exists:grades,id',
            'subject_id' => 'required|exists:subjects,id',
            'type' => 'required|in:0,1,2',
            'tuition_fee' => 'required|integer',
            'max_student' => 'integer',
            'min_student' => 'required|integer|min:' . env('COURSE_MIN_STUDENT', 3),
            'start_at' => 'required|date|after:today',
            'end_at' => 'required|date|after:start_at',
        ];
    }
}
