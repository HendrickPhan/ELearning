<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Helpers\Statics\UserRolesStatic;
use App\Helpers\Statics\UserStatusStatic;

class SubscribeStudentRequest extends FormRequest
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
            'id' => [
                Rule::exists('users')->where(function ($query) {
                    $query->where('role', UserRolesStatic::STUDENT);
                    $query->where('status', UserStatusStatic::ACTIVE);
                }),
            ]
        ];
    }

    public function all($keys = null)
    {
       // Add route parameters to validation data
       return array_merge(parent::all(), $this->route()->parameters());
    }
}
