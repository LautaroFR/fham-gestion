<x-app-layout>
<div class="space-y-6">
    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-bold">{{ $customer->name }}</h1>
            <p class="text-slate-500">{{ $customer->phone }} @if($customer->email) · {{ $customer->email }} @endif</p>
            @if($customer->address)<p class="text-slate-500">{{ $customer->address }}</p>@endif
        </div>
        <a href="{{ route('customers.edit',$customer) }}" class="px-4 py-2 bg-blue-600 text-white rounded">Editar Cliente</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow p-5"><div class="text-slate-500">Pedidos</div><div class="text-3xl font-bold">{{ $customer->orders_count }}</div></div>
        <div class="bg-white rounded-xl shadow p-5"><div class="text-slate-500">Facturado</div><div class="text-3xl font-bold">$ {{ number_format($customer->total_sold,0,',','.') }}</div></div>
        <div class="bg-white rounded-xl shadow p-5"><div class="text-slate-500">Cobrado</div><div class="text-3xl font-bold text-green-700">$ {{ number_format($customer->total_collected,0,',','.') }}</div></div>
        <div class="bg-white rounded-xl shadow p-5"><div class="text-slate-500">Pendiente</div><div class="text-3xl font-bold text-red-600">$ {{ number_format($customer->pending,0,',','.') }}</div></div>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100"><tr><th class="p-3 text-left">Pedido</th><th class="p-3 text-right">Precio</th><th class="p-3 text-right">Cobrado</th><th class="p-3 text-right">Saldo</th><th class="p-3 text-left">Estado</th><th class="p-3 text-right">Acción</th></tr></thead>
            <tbody>
            @forelse($customer->orders as $order)
                <tr class="border-b">
                    <td class="p-3">{{ $order->title }}</td>
                    <td class="p-3 text-right">$ {{ number_format($order->price,0,',','.') }}</td>
                    <td class="p-3 text-right text-green-700">$ {{ number_format($order->collected,0,',','.') }}</td>
                    <td class="p-3 text-right text-red-600">$ {{ number_format($order->balance,0,',','.') }}</td>
                    <td class="p-3">{{ $order->status }}</td>
                    <td class="p-3 text-right"><a href="{{ route('payments.create',['order_id'=>$order->id]) }}" class="text-green-700 hover:underline">Cobrar</a></td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center p-8 text-slate-500">Este cliente todavía no tiene pedidos.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
