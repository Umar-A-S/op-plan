<div>
    @if (session()->has('message'))
        <div class="text-green-500 mb-2">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="updateStatus" class="flex flex-col gap-2">
        <select wire:model="status" class="rounded border-gray-300">
            <option value="in_transit">In Transit</option>
            <option value="delivered">Delivered</option>
            <option value="failed">Failed</option>
        </select>
        
        @if($status === 'delivered')
            <input type="file" wire:model="podImage" class="text-sm">
            @error('podImage') <span class="text-red-500">{{ $message }}</span> @enderror
        @endif

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Simpan</button>
    </form>
</div>
