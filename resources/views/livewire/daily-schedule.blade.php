<div class="space-y-4" x-data="{ showModal: false, order: {} }">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Jadwal Pesanan Harian</h3>
        
        <div class="flex flex-wrap gap-2 items-center">
            <button wire:click="setFilter('today')" class="text-xs px-3 py-1 rounded-full {{ $filterType == 'today' ? 'bg-indigo-600 text-white' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300' }}">Hari Ini</button>
            <button wire:click="setFilter('yesterday')" class="text-xs px-3 py-1 rounded-full {{ $filterType == 'yesterday' ? 'bg-indigo-600 text-white' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300' }}">Kemarin</button>
            <button wire:click="setFilter('all')" class="text-xs px-3 py-1 rounded-full {{ $filterType == 'all' ? 'bg-indigo-600 text-white' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300' }}">Semua</button>
            <input type="date" wire:model.live="date" class="text-xs rounded-full border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900">
            <button wire:click="clearFilter" class="text-xs px-3 py-1 text-red-500 hover:text-red-700">Clear</button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
            <thead class="text-xs text-slate-700 dark:text-slate-400 uppercase bg-slate-50 dark:bg-slate-700">
                <tr>
                    <th class="px-4 py-3">No DO</th>
                    <th class="px-4 py-2">Penerima</th>
                    <th class="px-4 py-2">Driver</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                @foreach($orders as $order)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50">
                        <td class="px-4 py-3 font-medium">{{ $order->do_number }}</td>
                        <td class="px-4 py-3">{{ $order->recipient_name }}</td>
                        <td class="px-4 py-3">{{ $order->driver->name ?? 'Belum Ditugaskan' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <button @click="showModal = true; order = {{ json_encode($order) }}" class="bg-slate-500 text-white py-1 px-3 rounded-lg text-xs hover:bg-slate-600">Detail</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $orders->links() }}</div>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-slate-900/50 z-50" x-cloak @click.self="showModal = false">
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-xl w-1/3 border border-slate-200 dark:border-slate-700">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Detail Pesanan</h3>
            <p class="text-slate-600 dark:text-slate-300"><strong>No DO:</strong> <span x-text="order.do_number"></span></p>
            <p class="text-slate-600 dark:text-slate-300"><strong>Penerima:</strong> <span x-text="order.recipient_name"></span></p>
            <p class="text-slate-600 dark:text-slate-300"><strong>Alamat:</strong> <span x-text="order.delivery_address"></span></p>
            <p class="text-slate-600 dark:text-slate-300"><strong>Jadwal:</strong> <span x-text="order.scheduled_delivery"></span></p>
            <button @click="showModal = false" class="mt-6 bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600">Tutup</button>
        </div>
    </div>
</div>
