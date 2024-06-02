<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Kriteria;

class StoreKriteriaRequest extends FormRequest
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
            'kode' => 'required|string',
            'nama' => 'required|string',
            'bobot' => 'required|numeric|min:0|max:1',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $totalBobot = Kriteria::sum('bobot');
            $newBobot = $this->input('bobot');
            if ($totalBobot + $newBobot >= 1) {
                $validator->errors()->add('bobot', 'Total bobot kriteria tidak boleh lebih dari 1.');
            }
        });
    }
}
