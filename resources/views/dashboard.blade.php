<x-app-layout>
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Dashboard</h2>
            <p class="text-slate-500">Resumen comercial y financiero de FHAM</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('orders.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">+ Pedido</a>
            <a href="{{ route('payments.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">+ Cobro</a>
            <a href="{{ route('expenses.create') }}" class="bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 rounded-lg text-sm font-semibold">+ Gasto</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-6 gap-4">
        <div class="bg-white rounded-2xl shadow p-5">
            <div class="text-slate-500 text-sm">Facturado este mes</div>
            <div class="text-2xl font-bold text-slate-950 mt-1">$ {{ number_format($salesMonth,0,',','.') }}</div>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
            <div class="text-slate-500 text-sm">Cobrado este mes</div>
            <div class="text-2xl font-bold text-green-700 mt-1">$ {{ number_format($paymentsMonth,0,',','.') }}</div>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
            <div class="text-slate-500 text-sm">Pendiente total</div>
            <div class="text-2xl font-bold text-red-700 mt-1">$ {{ number_format($totalPending,0,',','.') }}</div>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
            <div class="text-slate-500 text-sm">Ganancia estimada mes</div>
            <div class="text-2xl font-bold text-slate-950 mt-1">$ {{ number_format($profitMonth,0,',','.') }}</div>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
            <div class="text-slate-500 text-sm">Gastos del mes</div>
            <div class="text-2xl font-bold text-orange-700 mt-1">$ {{ number_format($expensesMonth,0,',','.') }}</div>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
            <div class="text-slate-500 text-sm">Resultado caja mes</div>
            <div class="text-2xl font-bold {{ $resultMonth >= 0 ? 'text-green-700' : 'text-red-700' }} mt-1">$ {{ number_format($resultMonth,0,',','.') }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-2xl shadow p-5">
            <div class="text-slate-500 text-sm">Clientes</div>
            <div class="text-3xl font-bold mt-1">{{ $customersCount }}</div>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
            <div class="text-slate-500 text-sm">Pedidos</div>
            <div class="text-3xl font-bold mt-1">{{ $ordersCount }}</div>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
            <div class="text-slate-500 text-sm">Caja estimada total</div>
            <div class="text-3xl font-bold mt-1">$ {{ number_format($cashBalance,0,',','.') }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow p-5">
            <h3 class="font-bold mb-4">Últimos pedidos</h3>
            <div class="space-y-3">
                @forelse($latestOrders as $order)
                    <div class="flex justify-between border-b pb-2 gap-3">
                        <div>
                            <div class="font-semibold">{{ $order->title }}</div>
                            <div class="text-sm text-slate-500">{{ optional($order->order_date)->format('d/m/Y') }} · {{ $order->customer->name ?? '-' }}</div>
                        </div>
                        <div class="font-semibold whitespace-nowrap">$ {{ number_format($order->price,0,',','.') }}</div>
                    </div>
                @empty
                    <p class="text-slate-500">Sin pedidos.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-5">
            <h3 class="font-bold mb-4">Últimos cobros</h3>
            <div class="space-y-3">
                @forelse($latestPayments as $payment)
                    <div class="flex justify-between border-b pb-2 gap-3">
                        <div>
                            <div class="font-semibold">{{ $payment->order->customer->name ?? '-' }}</div>
                            <div class="text-sm text-slate-500">{{ $payment->payment_date->format('d/m/Y') }} · {{ $payment->method ?: 'Sin medio' }}</div>
                        </div>
                        <div class="font-semibold text-green-700 whitespace-nowrap">$ {{ number_format($payment->amount,0,',','.') }}</div>
                    </div>
                @empty
                    <p class="text-slate-500">Sin cobros.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-5">
            <h3 class="font-bold mb-4">Próximas entregas / instalaciones</h3>
            <div class="space-y-3">
                @forelse($upcomingOrders as $order)
                    <div class="flex justify-between border-b pb-2 gap-3">
                        <div>
                            <div class="font-semibold">{{ $order->title }}</div>
                            <div class="text-sm text-slate-500">{{ $order->customer->name ?? '-' }} · {{ $order->status }}</div>
                        </div>
                        <div class="font-semibold whitespace-nowrap">{{ optional($order->delivery_date)->format('d/m/Y') }}</div>
                    </div>
                @empty
                    <p class="text-slate-500">Sin entregas próximas.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
</x-app-layout>
