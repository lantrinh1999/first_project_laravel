<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class EditUserRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $a = array_column(User::select('email')->where('email', '!=', $value)->get()->toArray(), 'email');
                    if (in_array($value, $a)) {
                        $fail('Email Đã tồn tại!');
                    }
                },
            ],
            'password' => 'nullable|min:6|max:32',
            'confirm_password' => 'nullable|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Yêu cầu nhập tên',
            'email.required' => 'Yêu Cầu nhập email',
            'password.required' => 'Yêu cầu mật khẩu',
            'confirm_password.required' => 'Yêu cầu chọn trạng thái',
            'name.min' => 'Tên ít nhất 2 kí tự',
            'email.email' => 'Định dạng email không phù hợp',
            'password.max' => 'không vượt quá 32 kí tự',
            'password.min' => 'Nhiều hơn 6 kí tự',
        ];
    }
}
