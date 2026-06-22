<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole('Admin Logistik');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:drivers,phone|regex:/^08[0-9]{9,12}$/',
            'license_number' => 'required|string|unique:drivers,license_number|max:50',
            'license_expiry' => 'required|date|after:today',
            'status' => 'required|in:available,assigned,off_duty',
            'fleet_id' => 'required|exists:fleets,id',
            'rating' => 'nullable|numeric|between:0,5',
            'notes' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama driver harus diisi',
            'phone.unique' => 'Nomor telepon sudah terdaftar',
            'phone.regex' => 'Nomor telepon harus format 08xxxxxxxxxx',
            'license_number.unique' => 'Nomor SIM sudah terdaftar',
            'license_expiry.after' => 'Masa berlaku SIM harus lebih dari hari ini',
            'fleet_id.exists' => 'Armada yang dipilih tidak ditemukan',
        ];
    }
}
