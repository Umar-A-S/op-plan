<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Driver') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Nama</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $driver->name }}</p>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Telepon</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $driver->phone }}</p>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">No. SIM</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $driver->license_number }}</p>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Masa Berlaku SIM</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $driver->license_expiry }}</p>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Status</label>
                    <p class="mt-1 text-lg text-gray-900">{{ ucfirst($driver->status) }}</p>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Armada</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $driver->fleet->name }}</p>
                </div>
                <div class="flex items-center mt-4">
                    <a href="{{ route('drivers.edit', $driver->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                    <a href="{{ route('drivers.index') }}" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
