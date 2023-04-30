<?php

namespace App\Http\Requests;


use Illuminate\Http\Request;

class NewsUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required',
            'body' => 'required|string|min:2|max:2000',
            'title' => 'required|string|min:10|max"200',
        ];
    }
}
