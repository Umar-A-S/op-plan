<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-slate-800 dark:text-slate-100 leading-tight">
            {{ __('Laporan & Analitik') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Statistik Armada</h3>
                <canvas id="fleetChart" class="max-h-64"></canvas>
            </div>
            
            <a href="{{ route('reports.export') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg inline-block">Export ke CSV</a>

            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Performa Driver</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
                        <thead class="text-xs text-slate-700 dark:text-slate-400 uppercase bg-slate-50 dark:bg-slate-700">
                            <tr>
                                <th class="px-6 py-3">Driver</th>
                                <th class="px-6 py-3">Total Pesanan</th>
                                <th class="px-6 py-3">Rating</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                            @foreach($driverStats as $driver)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50">
                                    <td class="px-6 py-4 font-medium">{{ $driver->name }}</td>
                                    <td class="px-6 py-4">{{ $driver->delivery_orders_count }}</td>
                                    <td class="px-6 py-4">{{ $driver->rating }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('fleetChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Total Armada', 'Armada Aktif'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [{{ $fleetStats['total'] }}, {{ $fleetStats['active'] }}],
                        backgroundColor: ['rgba(79, 70, 229, 0.6)', 'rgba(16, 185, 129, 0.6)'],
                        borderColor: ['rgba(79, 70, 229, 1)', 'rgba(16, 185, 129, 1)'],
                        borderWidth: 1
                    }]
                },
                options: { 
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true, grid: { color: '#e2e8f0' } } } 
                }
            });
        });
    </script>
</x-app-layout>
