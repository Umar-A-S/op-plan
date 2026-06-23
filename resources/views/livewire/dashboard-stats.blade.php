<div wire:poll.30s class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
        <h4 class="text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider">Total Armada</h4>
        <p class="text-3xl font-extrabold text-slate-900 dark:text-white mt-2">{{ $totalFleets }}</p>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ $activeFleets }} Armada Aktif</p>
    </div>
    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
        <h4 class="text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider">Driver</h4>
        <p class="text-3xl font-extrabold text-slate-900 dark:text-white mt-2">{{ $totalDrivers }}</p>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ $availableDrivers }} Tersedia</p>
    </div>
    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
        <h4 class="text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider">Pesanan Pending</h4>
        <p class="text-3xl font-extrabold text-slate-900 dark:text-white mt-2">{{ $pendingOrders }}</p>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Perlu Tindakan</p>
    </div>
    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
        <h4 class="text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider">Total Pesanan</h4>
        <p class="text-3xl font-extrabold text-slate-900 dark:text-white mt-2">{{ $totalOrders }}</p>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Keseluruhan</p>
    </div>
</div>
