<div class="max-w-5xl mx-auto py-10">
    <h2 class="text-xl font-semibold mb-4">My Invoices</h2>
    @if (session('success'))
        <div class="p-3 bg-green-100 text-green-800 rounded mb-4">{{ session('success') }}</div>
    @endif
    <div class="flex items-center gap-3 mb-4">
        <label>Status</label>
        <select wire:model.live="statusFilter" class="border rounded px-3 py-2">
            <option value="">All</option>
            <option value="pending">Pending</option>
            <option value="suspended">Suspended</option>
            <option value="scheduled">Scheduled</option>
            <option value="overdue">Overdue</option>
            <option value="paid">Paid</option>
            <option value="not_received">Not Received</option>
        </select>
    </div>
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="text-left p-3">Reference</th>
                    <th class="text-left p-3">Gross</th>
                    <th class="text-left p-3">Fee</th>
                    <th class="text-left p-3">Net</th>
                    <th class="text-left p-3">Status</th>
                    <th class="text-left p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $inv)
                    <tr class="border-t">
                        <td class="p-3">{{ $inv->reference }}</td>
                        <td class="p-3">SAR {{ number_format($inv->gross_amount, 2) }}</td>
                        <td class="p-3">SAR {{ number_format($inv->fee_amount, 2) }}</td>
                        <td class="p-3">SAR {{ number_format($inv->net_amount, 2) }}</td>
                        <td class="p-3 capitalize">{{ str_replace('_', ' ', $inv->status->value) }}</td>
                        <td class="p-3">
                            <button wire:click="updateStatus({{ $inv->id }}, 'paid')" @disabled($inv->status->value !== 'overdue')
                                class="px-3 py-1 bg-emerald-600 text-white rounded disabled:opacity-50 disabled:cursor-not-allowed">Mark
                                Paid</button>
                                {{-- may be we will need this part sometimes in the future --}}
                            {{-- <button wire:click="updateStatus({{ $inv->id }}, 'not_received')"
                                @disabled($inv->status->value !== 'overdue')
                                class="px-3 py-1 bg-amber-600 text-white rounded ml-2 disabled:opacity-50 disabled:cursor-not-allowed">Not
                                Received</button> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $invoices->links() }}</div>
</div>
