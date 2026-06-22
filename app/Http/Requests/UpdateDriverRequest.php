<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole('Admin Logistik');
    }

    public function rules(): array
    {
        $driverId = $this->route('driver')->id;
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:drivers,phone,' . $driverId,
            'license_number' => 'required|string|max:50|unique:drivers,license_number,' . $driverId,
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
            'license_number.unique' => 'Nomor SIM sudah terdaftar',
            'license_expiry.after' => 'Masa berlaku SIM harus lebih dari hari ini',
            'fleet_id.exists' => 'Armada yang dipilih tidak ditemukan',
        ];
    }
}
