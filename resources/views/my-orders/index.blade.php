<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200 mt-4">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left">No. DO</th>
                            <th class="px-6 py-3 text-left">Penerima</th>
                            <th class="px-6 py-3 text-left">Alamat</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deliveryOrders as $order)
                            <tr>
                                <td class="px-6 py-4">{{ $order->do_number }}</td>
                                <td class="px-6 py-4">{{ $order->recipient_name }}</td>
                                <td class="px-6 py-4">{{ $order->delivery_address }}</td>
                                <td class="px-6 py-4">{{ ucfirst($order->status) }}</td>
                                <td class="px-6 py-4">
                                    <livewire:update-delivery-status :order="$order" :key="$order->id" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $deliveryOrders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
