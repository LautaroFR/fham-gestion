<x-app-layout>
<div class="max-w-7xl mx-auto py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold">Pedidos</h2>
            <p class="text-gray-500">{{ $orders->total() }} pedido(s)</p>
        </div>

        <a href="{{ route('orders.create') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">
            + Nuevo Pedido
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 rounded p-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full bg-white rounded shadow">
        <thead class="bg-gray-100">
            <tr class="border-b">
                <th class="p-3 text-left">Fecha</th>
                <th class="p-3 text-left">Cliente</th>
                <th class="p-3 text-left">Pedido</th>
                <th class="p-3 text-right">Precio</th>
                <th class="p-3 text-right">Cobrado</th>
                <th class="p-3 text-right">Saldo</th>
                <th class="p-3 text-left">Cobro</th>
                <th class="p-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ optional($order->order_date)->format('d/m/Y') }}</td>
                <td class="p-3">{{ $order->customer->name }}</td>
                <td class="p-3">
                    <a href="{{ route('orders.show', $order) }}" class="text-blue-600 font-semibold hover:underline">
                        {{ $order->title }}
                    </a>
                </td>
                <td class="p-3 text-right">$ {{ number_format($order->price, 0, ',', '.') }}</td>
                <td class="p-3 text-right">$ {{ number_format($order->collected, 0, ',', '.') }}</td>
                <td class="p-3 text-right font-semibold {{ $order->balance > 0 ? 'text-red-600' : 'text-green-700' }}">
                    $ {{ number_format($order->balance, 0, ',', '.') }}
                </td>
                <td class="p-3">{{ $order->payment_status }}</td>
                <td class="p-3 text-right">
                    <a href="{{ route('orders.show', $order) }}" class="text-blue-600 hover:underline">Ver</a>
                    <a href="{{ route('orders.edit', $order) }}" class="text-blue-600 hover:underline ml-3">Editar</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="p-6 text-center text-gray-500">No hay pedidos cargados.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-6">{{ $orders->links() }}</div>
</div>
</x-app-layout>
