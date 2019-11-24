<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportAttendanceRequest extends FormRequest
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
            'company_id' => 'required',
            'month' => 'required',
            'year' => 'required',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required' => 'Este campo é obrigatório.',
        ];
    }
}
