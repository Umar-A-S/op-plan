<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesanan Pengiriman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">No. DO</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $deliveryOrder->do_number }}</p>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Penerima</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $deliveryOrder->recipient_name }} ({{ $deliveryOrder->recipient_phone }})</p>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Alamat</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $deliveryOrder->delivery_address }}</p>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Status</label>
                    <p class="mt-1 text-lg text-gray-900">{{ ucfirst($deliveryOrder->status) }}</p>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Driver</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $deliveryOrder->driver ? $deliveryOrder->driver->name : '-' }}</p>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Armada</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $deliveryOrder->fleet->name }}</p>
                </div>

                @if($deliveryOrder->pod_image_path)
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Bukti Pengiriman (POD)</label>
                        <img src="{{ asset('storage/' . $deliveryOrder->pod_image_path) }}" class="w-64 mt-2 border rounded">
                    </div>
                @endif

                @if($deliveryOrder->latitude && $deliveryOrder->longitude)
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Lokasi Terakhir</label>
                        <div class="mt-2 h-64 w-full" id="map"></div>
                    </div>
                    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                    <script>
                        var map = L.map('map').setView([{{ $deliveryOrder->latitude }}, {{ $deliveryOrder->longitude }}], 13);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
                        L.marker([{{ $deliveryOrder->latitude }}, {{ $deliveryOrder->longitude }}]).addTo(map);
                    </script>
                @endif

                <div class="flex items-center mt-4">
                    <a href="{{ route('delivery-orders.edit', $deliveryOrder->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                    <a href="{{ route('delivery-orders.index') }}" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
