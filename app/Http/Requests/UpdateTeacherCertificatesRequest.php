<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherCertificatesRequest extends FormRequest
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
            'certificates' => 'array',
            'certificates.*.id' =>'exists:certificates,id',
            'certificates.*.date_of_issue' =>'date',
            'certificates.*.remove' =>'in:0,1',
        ];
    }
}
