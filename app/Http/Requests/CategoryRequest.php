<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        if ($this['_method'] == 'PUT') {
            $parentId = $this['parent_id'];
            $rules = [
                'name' => 'required|min:3|max:100|
                unique:Categories,name,NULL,id,deleted_at,NULL,parent_id,' . $parentId,
            ];
        } else {
            $rules = [
                'name' => 'required|min:3|max:100|unique:Categories,name,NULL,id,deleted_at,NULL',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'name.required' => trans('messages.category_validate_required'),
            'name.min' => trans('messages.category_validate_length'),
            'name.max' => trans('messages.category_validate_length'),
        ];

        if ($this['_method'] == 'PUT') {
            $messages = $messages + [
                    'name.unique' => trans('messages.category_validate_unique_update'),
                ];
        } else {
            $messages = $messages + [
                    'name.unique' => trans('messages.category_validate_unique_create'),
                ];
        }

        return $messages;
    }
}
