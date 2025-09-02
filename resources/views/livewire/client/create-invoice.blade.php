<div class="max-w-xl mx-auto py-10 space-y-6">
    <h2 class="text-xl font-semibold">Create Invoice</h2>
    @if (session('success'))
        <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium mb-1">Merchant</label>
            <select wire:model="merchant_id" class="w-full border rounded px-3 py-2">
                <option value="">Select merchant</option>
                @foreach ($merchants as $m)
                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                @endforeach
            </select>
            @error('merchant_id')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Invoice amount (SAR)</label>
            <input type="number" step="0.01" min="1" wire:model="amount"
                class="w-full border rounded px-3 py-2" />
            @error('amount')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex justify-end">
            <button wire:click="create" class="px-6 py-2 bg-indigo-600 text-white rounded">Create</button>
        </div>
    </div>
</div>
