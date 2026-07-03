<x-app-layout>
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div><h2 class="text-2xl font-bold">Pedidos</h2><p class="text-slate-500">Listado de trabajos y obras</p></div>
        <a href="{{ route('orders.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Nuevo Pedido</a>
    </div>
    @if(session('success'))<div class="bg-green-100 border border-green-300 rounded p-3">{{ session('success') }}</div>@endif
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100"><tr><th class="p-3 text-left">Cliente</th><th class="p-3 text-left">Pedido</th><th class="p-3 text-right">Precio</th><th class="p-3 text-right">Cobrado</th><th class="p-3 text-right">Saldo</th><th class="p-3 text-left">Estado</th><th class="p-3 text-right">Acciones</th></tr></thead>
            <tbody>
            @forelse($orders as $order)
                <tr class="border-b hover:bg-slate-50">
                    <td class="p-3">{{ $order->customer->name }}</td>
                    <td class="p-3 font-semibold">{{ $order->title }}</td>
                    <td class="p-3 text-right">$ {{ number_format($order->price,0,',','.') }}</td>
                    <td class="p-3 text-right text-green-700">$ {{ number_format($order->collected,0,',','.') }}</td>
                    <td class="p-3 text-right font-semibold {{ $order->balance > 0 ? 'text-red-600' : 'text-green-700' }}">$ {{ number_format($order->balance,0,',','.') }}</td>
                    <td class="p-3">{{ $order->status }}</td>
                    <td class="p-3 text-right">
                        <a href="{{ route('payments.create',['order_id'=>$order->id]) }}" class="text-green-700 hover:underline">Cobrar</a>
                        <a href="{{ route('orders.edit',$order) }}" class="text-blue-600 ml-3 hover:underline">Editar</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center p-10 text-slate-500">No hay pedidos cargados.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $orders->links() }}
</div>
</x-app-layout>
