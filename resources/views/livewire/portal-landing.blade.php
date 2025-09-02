<div class="max-w-2xl mx-auto py-12">
    <div class="text-center space-y-4">
        <h1 class="text-2xl font-semibold">Welcome to Floosy</h1>
        <p class="text-slate-600">Choose your portal</p>
        <div class="flex items-center justify-center gap-6 mt-6">
            <button wire:click="openClientLogin" class="px-6 py-3 bg-blue-600 text-white rounded">I'm a Client</button>
            <button wire:click="openMerchantLogin" class="px-6 py-3 bg-emerald-600 text-white rounded">I'm a
                Merchant</button>
        </div>
    </div>

    @if ($showClientLogin || $showMerchantLogin)
        <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow w-full max-w-md p-6">
                <h2 class="text-lg font-medium mb-4">Login ({{ $loginContext }})</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" wire:model.defer="email" class="w-full border rounded px-3 py-2" />
                        @error('email')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Password</label>
                        <input type="password" wire:model.defer="password" class="w-full border rounded px-3 py-2" />
                        @error('password')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end gap-2">
                        <button wire:click="closeModals" class="px-4 py-2 border rounded">Cancel</button>
                        <button wire:click="login" class="px-4 py-2 bg-indigo-600 text-white rounded">Login</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
