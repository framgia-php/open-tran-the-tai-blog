<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [];
        if ($this['_method'] == 'PUT') {
            if ($this['changePassword'] == 'on') {
                $rules += [
                    '_password' => 'required|min:3|max:32|confirmed',
                ];
            } else {
                $rules += [
                    'name' => 'required|min:3|unique:Users,name,NULL,id,deleted_at,NULL,email,' . $this['email'],
                ];
            }
        } else {
            $rules += [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:Users,email,NULL,id,deleted_at,NULL',
                '_password' => 'required|min:3|max:32|confirmed',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        if ($this['_method'] == 'PUT') {
            if ($this['changePassword'] == 'on') {
                $messages += [
                    'name.required' => trans('messages.name.required'),
                    'name.min' => trans('messages.name.min'),
                    '_password.required' => trans('messages.password.required'),
                    '_password.min' => trans('messages.password.min'),
                    '_password.max' => trans('messages.password.max'),
                    '_password.confirmed' => trans('messages.confirmed'),
                ];
            } else {
                $messages += [
                    'name.unique' => trans('messages.account.unique'),
                ];
            }
        } else {
            $messages += [
                'name.required' => trans('messages.name.required'),
                'name.min' => trans('messages.name.min'),
                'email.required' => trans('messages.email.required'),
                'email.email' => trans('messages.email.email'),
                'email.unique' => trans('messages.email.unique'),
                '_password.required' => trans('messages.password.required'),
                '_password.min' => trans('messages.password.min'),
                '_password.max' => trans('messages.password.max'),
                '_password.confirmed' => trans('messages.confirmed'),
            ];
        }

        return $messages;
    }
}
