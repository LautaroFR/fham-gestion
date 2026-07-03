<x-app-layout>
<div class="max-w-7xl mx-auto py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Pedidos</h2>

        <a href="{{ route('orders.create') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">
            Nuevo Pedido
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 rounded p-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="border-b">
                <th class="p-3 text-left">Fecha</th>
                <th class="p-3 text-left">Cliente</th>
                <th class="p-3 text-left">Pedido</th>
                <th class="p-3 text-right">Precio</th>
                <th class="p-3 text-right">Costo</th>
                <th class="p-3 text-right">Ganancia</th>
                <th class="p-3 text-left">Estado</th>
                <th class="p-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr class="border-b">
                <td class="p-3">{{ $order->created_at->format('d/m/Y') }}</td>
                <td class="p-3">{{ $order->customer->name }}</td>
                <td class="p-3">{{ $order->title }}</td>
                <td class="p-3 text-right">${{ number_format($order->price, 0, ',', '.') }}</td>
                <td class="p-3 text-right">${{ number_format($order->cost, 0, ',', '.') }}</td>
                <td class="p-3 text-right">${{ number_format($order->profit, 0, ',', '.') }}</td>
                <td class="p-3">{{ $order->status }}</td>
                <td class="p-3 text-right">
                    <a href="{{ route('orders.edit', $order) }}" class="text-blue-600">Editar</a>

                    <form method="POST" action="{{ route('orders.destroy', $order) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('¿Eliminar pedido?')"
                                class="text-red-600 ml-4">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="p-6 text-center text-gray-500">
                    No hay pedidos cargados.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>
</x-app-layout>