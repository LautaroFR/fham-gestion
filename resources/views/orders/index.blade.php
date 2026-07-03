<x-app-layout>
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold">Pedidos</h2>
            <p class="text-slate-500">Pedidos cargados por fecha real del pedido.</p>
        </div>
        <a href="{{ route('orders.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">+ Nuevo Pedido</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 rounded p-3">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100">
                <tr>
                    <th class="p-3 text-left">Fecha pedido</th>
                    <th class="p-3 text-left">Cliente</th>
                    <th class="p-3 text-left">Pedido</th>
                    <th class="p-3 text-right">Precio</th>
                    <th class="p-3 text-right">Cobrado</th>
                    <th class="p-3 text-right">Saldo</th>
                    <th class="p-3 text-left">Estado</th>
                    <th class="p-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="border-b hover:bg-slate-50">
                        <td class="p-3">{{ optional($order->order_date)->format('d/m/Y') }}</td>
                        <td class="p-3 font-semibold">{{ $order->customer->name ?? '-' }}</td>
                        <td class="p-3">
                            <div class="font-semibold">{{ $order->title }}</div>
                            <div class="text-xs text-slate-500">{{ $order->project }} {{ $order->room ? '· '.$order->room : '' }}</div>
                        </td>
                        <td class="p-3 text-right">$ {{ number_format($order->price,0,',','.') }}</td>
                        <td class="p-3 text-right text-green-700">$ {{ number_format($order->collected,0,',','.') }}</td>
                        <td class="p-3 text-right {{ $order->balance > 0 ? 'text-red-700 font-semibold' : 'text-green-700 font-semibold' }}">$ {{ number_format($order->balance,0,',','.') }}</td>
                        <td class="p-3">{{ $order->status }}</td>
                        <td class="p-3 text-right">
                            <a href="{{ route('orders.edit', $order) }}" class="text-blue-600 hover:underline">Editar</a>
                            <form method="POST" action="{{ route('orders.destroy', $order) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('¿Eliminar pedido?')" class="text-red-600 ml-4 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="p-8 text-center text-slate-500">No hay pedidos cargados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>{{ $orders->links() }}</div>
</div>
</x-app-layout>
