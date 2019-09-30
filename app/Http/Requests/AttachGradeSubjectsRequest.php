<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachGradeSubjectsRequest extends FormRequest
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
            //
            'grade_subjects' => 'required|array',
            'grade_subjects.*.grade_id' => 'required|exists:grades,id',
            'grade_subjects.*.subject_id' => 'required|exists:subjects,id',
        ];
    }
}
