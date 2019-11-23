<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttendanceRequest extends FormRequest
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
            'client' => 'required|string',
            'requester' => 'required|string',
            'agent_id' => 'required',
            'time_trigger' => 'required',
            'time_checkin' => 'required',
            'time_exit' => 'required',
            'note' => 'required|string'
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
            '*.string' => 'Este campo precisa ser texto.',
            ];
    }
}
