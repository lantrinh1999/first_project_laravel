<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistryRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Yêu cầu nhập tên',
            'email.required' => 'Yêu cầu nhập email',
            'password.required' => 'Yêu cầu nhập mật khẩu',
            'confirm_password.required' => 'Yêu cầu nhập xác nhận',
            'email.unique' => 'Email đã tồn tại.Điền email khác',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'password.min' => 'Mật khẩu ít nhất 6 kí tự',
            'confirm_password.same' => 'Xác nhận mật khẩu sai!',
        ];
    }
}
