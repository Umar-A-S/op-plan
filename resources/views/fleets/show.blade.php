<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Armada') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Nama</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $fleet->name }}</p>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Kode</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $fleet->code }}</p>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Total Kendaraan</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $fleet->total_vehicles }}</p>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Status</label>
                    <p class="mt-1 text-lg text-gray-900">{{ ucfirst($fleet->status) }}</p>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Deskripsi</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $fleet->description }}</p>
                </div>
                <div class="flex items-center mt-4">
                    <a href="{{ route('fleets.edit', $fleet->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                    <a href="{{ route('fleets.index') }}" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
