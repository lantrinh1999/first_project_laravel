<?php

namespace App\Http\Requests;

use App\Rules\selectMultiplaRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id' => [
                'required',
                new selectMultiplaRule(),
            ],
            'name' => 'required|min:8|string',
            'price' => 'required|numeric|min:1',
            'status' => 'numeric|min:0|max:1|required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Yêu cầu nhập tên',
            'category_id.required' => 'Yêu Cầu chọn danh mục',
            'price.required' => 'Yêu cầu nhập giá',
            'status.required' => 'Yêu cầu chọn trạng thái',
            'name.string' => 'tên lớp là 1 chuỗi',
            'name.min' => 'Tên ít nhất 8 kí tự',
            'status.min' => 'Trạng thái không phù hợp',
            'status.max' => 'Trạng thái không phù hợp',
            'name.unique' => 'tên đã tồn tại, mời nhập tên khác',
        ];
    }
}
