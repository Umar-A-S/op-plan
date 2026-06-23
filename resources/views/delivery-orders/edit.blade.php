<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pesanan Pengiriman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('delivery-orders.update', $deliveryOrder->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <x-input-label for="do_number" :value="__('No. DO')" />
                        <x-text-input id="do_number" name="do_number" type="text" class="mt-1 block w-full" :value="old('do_number', $deliveryOrder->do_number)" required autofocus />
                        <x-input-error :messages="$errors->get('do_number')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="recipient_name" :value="__('Nama Penerima')" />
                        <x-text-input id="recipient_name" name="recipient_name" type="text" class="mt-1 block w-full" :value="old('recipient_name', $deliveryOrder->recipient_name)" required />
                        <x-input-error :messages="$errors->get('recipient_name')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="recipient_phone" :value="__('Telepon Penerima')" />
                        <x-text-input id="recipient_phone" name="recipient_phone" type="text" class="mt-1 block w-full" :value="old('recipient_phone', $deliveryOrder->recipient_phone)" required />
                        <x-input-error :messages="$errors->get('recipient_phone')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="delivery_address" :value="__('Alamat Pengiriman')" />
                        <textarea id="delivery_address" name="delivery_address" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('delivery_address', $deliveryOrder->delivery_address) }}</textarea>
                        <x-input-error :messages="$errors->get('delivery_address')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="scheduled_delivery" :value="__('Jadwal Pengiriman')" />
                        <x-text-input id="scheduled_delivery" name="scheduled_delivery" type="date" class="mt-1 block w-full" :value="old('scheduled_delivery', $deliveryOrder->scheduled_delivery)" required />
                        <x-input-error :messages="$errors->get('scheduled_delivery')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="pending" {{ old('status', $deliveryOrder->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="assigned" {{ old('status', $deliveryOrder->status) == 'assigned' ? 'selected' : '' }}>Ditugaskan</option>
                            <option value="in_transit" {{ old('status', $deliveryOrder->status) == 'in_transit' ? 'selected' : '' }}>Dalam Perjalanan</option>
                            <option value="delivered" {{ old('status', $deliveryOrder->status) == 'delivered' ? 'selected' : '' }}>Terkirim</option>
                            <option value="failed" {{ old('status', $deliveryOrder->status) == 'failed' ? 'selected' : '' }}>Gagal</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="fleet_id" :value="__('Armada')" />
                        <select id="fleet_id" name="fleet_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach ($fleets as $fleet)
                                <option value="{{ $fleet->id }}" {{ old('fleet_id', $deliveryOrder->fleet_id) == $fleet->id ? 'selected' : '' }}>{{ $fleet->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('fleet_id')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="driver_id" :value="__('Driver')" />
                        <select id="driver_id" name="driver_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Pilih Driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ old('driver_id', $deliveryOrder->driver_id) == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('driver_id')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Simpan Perubahan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
