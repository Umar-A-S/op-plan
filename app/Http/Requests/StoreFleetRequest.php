<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFleetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole('Admin Logistik');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:fleets,code|max:50',
            'total_vehicles' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama armada harus diisi',
            'code.required' => 'Kode armada harus diisi',
            'code.unique' => 'Kode armada sudah terdaftar',
            'total_vehicles.integer' => 'Jumlah kendaraan harus berupa angka',
            'status.in' => 'Status harus active atau inactive',
        ];
    }
}
