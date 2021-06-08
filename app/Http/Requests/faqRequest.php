<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class faqRequest extends FormRequest
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
            'question'=>'required',
            'answer'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'question.required'=>'Question dite hobe',
            'answer.required'=>'Answer dite hobe',
        ];
    }
}
