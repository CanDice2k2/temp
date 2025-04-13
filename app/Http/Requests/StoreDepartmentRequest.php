<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $department = $this->route('department');

        $rules = [
            'address' => 'required'
        ];

        // Nếu đang update (có department trong route)
        if ($department) {
            $rules['name'] = [
                'required',
                Rule::unique('departments')->ignore($department->id)
            ];

            $rules['code'] = [
                'required',
                'size:3', // Giới hạn chính xác 3 ký tự
                Rule::unique('departments')->ignore($department->id)
            ];
        } else {
            // Đang tạo mới
            $rules['name'] = 'required|unique:departments,name';
            $rules['code'] = 'required|size:3|unique:departments,code'; // Giới hạn chính xác 3 ký tự
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'code.size' => 'Mã phòng ban phải chính xác 3 ký tự.',
        ];
    }
}
