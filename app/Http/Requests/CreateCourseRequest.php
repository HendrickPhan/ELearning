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
            'name' => 'required',
            'avatar' => 'required|image',
            'description' => 'required',
            'short_description' => 'required',
            'tuition_fee' => 'required|integer',
            'grade_id' => 'required|exists:grades,id',
            'subject_id' => 'required|exists:subjects,id',
            'min_student' => 'required|integer|min:' . env('COURSE_MIN_STUDENT', 3),
            'start_at' => 'required|date|after:today',
            'end_at' => 'required|date|after:start_at',

            'lessons' => 'required|array',
            'lessons.*.id' =>'exists:certificates,id',
            'lessons.*.start_at' => 'required|date|after:today',
            'lessons.*.end_at' => 'required|date|after:lessons.*.start_at',
        ];
    }
}
