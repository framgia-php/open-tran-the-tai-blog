<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
        $rules = [
            'summary' => 'required',
            'content' => 'required',
            'image' => 'image|max:10000',
        ];
        if ($this['_method'] == 'PUT') {
            $cat = $this['category_id'];
            $rules += [
                'title' => 'required|min:3|unique:News,title,NULL,id,deleted_at,NULL,category_id,' . $cat,
            ];
        } else {
            $rules += [
                'title' => 'required|min:3|unique:News,title,NULL,id,deleted_at,NULL',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'title.required' => trans('messages.title.required'),
            'title.min' => trans('messages.title.min'),
            'summary.required' => trans('messages.summary.required'),
            'content.required' => trans('messages.content.required'),
            'image.image' => trans('messages.image.image'),
            'image.max' => trans('messages.image.max'),
        ];

        if ($this['_method'] == 'PUT') {
            $messages += [
                'title.unique' => trans('messages.news_validate_unique_update'),
            ];
        } else {
            $messages += [
                'title.unique' => trans('messages.title.unique'),
            ];
        }

        return $messages;
    }
}
