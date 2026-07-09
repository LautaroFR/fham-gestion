<x-app-layout>
<div class="max-w-7xl mx-auto py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold">Cobros</h2>
            <p class="text-gray-500">{{ $payments->total() }} cobro(s)</p>
        </div>

        <a href="{{ route('payments.create') }}"
           class="inline-flex items-center px-4 py-2 bg-green-600 rounded-md font-semibold text-xs text-white uppercase hover:bg-green-700">
            + Nuevo Cobro
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 rounded p-3 mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full bg-white rounded shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Fecha</th>
                <th class="p-3 text-left">Cliente</th>
                <th class="p-3 text-left">Pedido</th>
                <th class="p-3 text-left">Medio</th>
                <th class="p-3 text-right">Importe</th>
                <th class="p-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($payments as $payment)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $payment->payment_date->format('d/m/Y') }}</td>
                <td class="p-3">{{ $payment->order->customer->name }}</td>
                <td class="p-3">
                    <a href="{{ route('orders.show', $payment->order) }}" class="text-blue-600 hover:underline">
                        {{ $payment->order->title }}
                    </a>
                </td>
                <td class="p-3">{{ $payment->method }}</td>
                <td class="p-3 text-right">{{ $payment->currencySymbol() }} {{ number_format($payment->amount,0,',','.') }}</td>
                <td class="p-3 text-right">
                    <a href="{{ route('payments.edit', $payment) }}" class="text-blue-600 hover:underline">Editar</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="p-6 text-center text-gray-500">No hay cobros cargados.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-6">{{ $payments->links() }}</div>
</div>
</x-app-layout>
