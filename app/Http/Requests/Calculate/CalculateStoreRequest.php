<?php

namespace App\Http\Requests\Calculate;

use Illuminate\Foundation\Http\FormRequest;

class CalculateStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'selected_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:today']
        ];
    }
}
