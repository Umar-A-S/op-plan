<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole(['Admin Logistik', 'Manager']);
    }

    public function rules(): array
    {
        $orderId = $this->route('delivery_order')->id;
        return [
            'do_number' => 'required|string|max:50|unique:delivery_orders,do_number,' . $orderId,
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|regex:/^08[0-9]{9,12}$/',
            'delivery_address' => 'required|string|max:500',
            'driver_id' => 'nullable|exists:drivers,id',
            'fleet_id' => 'required|exists:fleets,id',
            'scheduled_delivery' => 'required|date',
            'status' => 'required|in:pending,assigned,in_transit,delivered,failed',
            'actual_delivery' => 'nullable|date',
            'notes' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'do_number.unique' => 'Nomor DO sudah terdaftar',
            'recipient_name.required' => 'Nama penerima harus diisi',
            'recipient_phone.regex' => 'Nomor telepon harus format 08xxxxxxxxxx',
            'delivery_address.required' => 'Alamat pengiriman harus diisi',
            'fleet_id.exists' => 'Armada yang dipilih tidak ditemukan',
            'driver_id.exists' => 'Driver yang dipilih tidak ditemukan',
        ];
    }
}
