<aside class="w-64 bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 h-screen hidden md:block">
    <div class="p-6">
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">OPLAN</a>
    </div>
    
    <nav class="mt-6">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block py-2.5 px-6 hover:bg-slate-50 dark:hover:bg-slate-700">
            {{ __('Dashboard') }}
        </x-nav-link>

        @role('Admin Logistik|Manager')
            <x-nav-link :href="route('fleets.index')" :active="request()->routeIs('fleets.*')" class="block py-2.5 px-6 hover:bg-slate-50 dark:hover:bg-slate-700">
                {{ __('Armada') }}
            </x-nav-link>
            <x-nav-link :href="route('drivers.index')" :active="request()->routeIs('drivers.*')" class="block py-2.5 px-6 hover:bg-slate-50 dark:hover:bg-slate-700">
                {{ __('Driver') }}
            </x-nav-link>
            <x-nav-link :href="route('delivery-orders.index')" :active="request()->routeIs('delivery-orders.*')" class="block py-2.5 px-6 hover:bg-slate-50 dark:hover:bg-slate-700">
                {{ __('Pesanan') }}
            </x-nav-link>
            <x-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')" class="block py-2.5 px-6 hover:bg-slate-50 dark:hover:bg-slate-700">
                {{ __('Laporan') }}
            </x-nav-link>
        @endrole

        @role('Driver')
            <x-nav-link :href="route('delivery-orders.mine')" :active="request()->routeIs('delivery-orders.mine')" class="block py-2.5 px-6 hover:bg-slate-50 dark:hover:bg-slate-700">
                {{ __('Pesanan Saya') }}
            </x-nav-link>
        @endrole
    </nav>
</aside>
