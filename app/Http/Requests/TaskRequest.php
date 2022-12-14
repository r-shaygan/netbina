<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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

    public function rules()
    {
        return [
            'title'=>'required|min:3|max:100',
            'description'=>'required|min:3|max:500',
            'deadline'=>'required|date|after:+30 minute',
            'assigned'=>'required|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'title.exist' => 'Bad Information!'
        ];
    }
}
