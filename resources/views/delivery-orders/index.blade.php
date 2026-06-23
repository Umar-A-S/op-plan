<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-slate-800 dark:text-slate-100 leading-tight">
            {{ __('Daftar Pesanan Pengiriman') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                <a href="{{ route('delivery-orders.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg mb-4 inline-block">Tambah Pesanan Baru</a>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
                        <thead class="text-xs text-slate-700 dark:text-slate-400 uppercase bg-slate-50 dark:bg-slate-700">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">No. DO</th>
                                <th class="px-6 py-3">Penerima</th>
                                <th class="px-6 py-3">Alamat</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Driver</th>
                                <th class="px-6 py-3">Armada</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                            @foreach ($deliveryOrders as $order)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50">
                                    <td class="px-6 py-4 font-medium">{{ $order->id }}</td>
                                    <td class="px-6 py-4">{{ $order->do_number }}</td>
                                    <td class="px-6 py-4">{{ $order->recipient_name }}</td>
                                    <td class="px-6 py-4 truncate max-w-[150px]">{{ $order->delivery_address }}</td>
                                    <td class="px-6 py-4">{{ ucfirst($order->status) }}</td>
                                    <td class="px-6 py-4">{{ $order->driver ? $order->driver->name : '-' }}</td>
                                    <td class="px-6 py-4">{{ $order->fleet->name }}</td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('delivery-orders.show', $order->id) }}" class="text-indigo-500 hover:text-indigo-700">Lihat</a>
                                        <a href="{{ route('delivery-orders.edit', $order->id) }}" class="text-amber-500 hover:text-amber-700">Edit</a>
                                        <form action="{{ route('delivery-orders.destroy', $order->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $deliveryOrders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
