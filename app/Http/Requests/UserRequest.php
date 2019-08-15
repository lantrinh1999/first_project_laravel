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
        return [
            'name' => 'required|min:2',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6|max:32',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Yêu cầu nhập tên',
            'email.required' => 'Yêu Cầu nhập email',
            'password.required' => 'Yêu cầu mật khẩu',
            'confirm_password.required' => 'Yêu cầu mật khẩu',
            'name.min' => 'Tên ít nhất 2 kí tự',
            'email.email' => 'Định dạng email không phù hợp',
            'password.max' => 'không vượt quá 32 kí tự',
            'password.min' => 'Nhiều hơn 6 kí tự',
            'email.unique' => 'email đã tồn tại, mời nhập email khác',
        ];
    }
}
