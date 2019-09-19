<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterTeacherRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'name' => 'required',
            'avatar' => 'required|image',
            'description' => 'required',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required',
            'address' => 'required',
            'certificates' => 'array',
            'certificates.*.id' =>'exists:certificates,id',
            'grade_subjects' => 'array',
            'experience' => 'string'
        ];
    }
}
