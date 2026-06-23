<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Driver Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('drivers.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="phone" :value="__('Telepon')" />
                        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" required />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="license_number" :value="__('No. SIM')" />
                        <x-text-input id="license_number" name="license_number" type="text" class="mt-1 block w-full" :value="old('license_number')" required />
                        <x-input-error :messages="$errors->get('license_number')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="license_expiry" :value="__('Masa Berlaku SIM')" />
                        <x-text-input id="license_expiry" name="license_expiry" type="date" class="mt-1 block w-full" :value="old('license_expiry')" required />
                        <x-input-error :messages="$errors->get('license_expiry')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                            <option value="assigned" {{ old('status') == 'assigned' ? 'selected' : '' }}>Ditugaskan</option>
                            <option value="off_duty" {{ old('status') == 'off_duty' ? 'selected' : '' }}>Off Duty</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="fleet_id" :value="__('Armada')" />
                        <select id="fleet_id" name="fleet_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach ($fleets as $fleet)
                                <option value="{{ $fleet->id }}" {{ old('fleet_id') == $fleet->id ? 'selected' : '' }}>{{ $fleet->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('fleet_id')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Simpan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
