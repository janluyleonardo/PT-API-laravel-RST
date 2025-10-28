<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ImportProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|mimes:xlsx,xls|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'El archivo es obligatorio.',
            'file.mimes' => 'El archivo debe ser de tipo Excel (.xlsx o .xls).',
            'file.max' => 'El archivo no debe superar los 5MB.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => '422',
            'message' => 'Error en la validación de los datos.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
