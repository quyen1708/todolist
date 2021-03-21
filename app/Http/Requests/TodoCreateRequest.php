<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoCreateRequest extends FormRequest
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
            'title'=>'required|max:255',
            'desc'=>'required|max:6000',
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'Title is required!',
            'desc.required'=>'Title is required!',
            'title.max'=>'Title is no longger than 255 character!',
            'desc.max'=>'Description too big!',
        ];
    }
}
