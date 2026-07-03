<x-app-layout>
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-bold">Dashboard</h2>
        <p class="text-slate-500">Resumen general de FHAM</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-slate-500 text-sm">Ventas del mes</div>
            <div class="text-2xl font-bold">$ {{ number_format($salesMonth,0,',','.') }}</div>
        </div>
        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-slate-500 text-sm">Cobrado del mes</div>
            <div class="text-2xl font-bold text-green-700">$ {{ number_format($paymentsMonth,0,',','.') }}</div>
        </div>
        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-slate-500 text-sm">Pendiente total</div>
            <div class="text-2xl font-bold text-red-700">$ {{ number_format($totalPending,0,',','.') }}</div>
        </div>
        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-slate-500 text-sm">Caja estimada</div>
            <div class="text-2xl font-bold">$ {{ number_format($cashBalance,0,',','.') }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-slate-500 text-sm">Ganancia estimada mes</div>
            <div class="text-2xl font-bold">$ {{ number_format($profitMonth,0,',','.') }}</div>
        </div>
        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-slate-500 text-sm">Gastos del mes</div>
            <div class="text-2xl font-bold">$ {{ number_format($expensesMonth,0,',','.') }}</div>
        </div>
        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-slate-500 text-sm">Clientes</div>
            <div class="text-2xl font-bold">{{ $customersCount }}</div>
        </div>
        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-slate-500 text-sm">Pedidos</div>
            <div class="text-2xl font-bold">{{ $ordersCount }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow p-5">
            <h3 class="font-bold mb-4">Últimos pedidos</h3>
            <div class="space-y-3">
                @forelse($latestOrders as $order)
                    <div class="flex justify-between border-b pb-2">
                        <div>
                            <div class="font-semibold">{{ $order->title }}</div>
                            <div class="text-sm text-slate-500">{{ $order->customer->name ?? '-' }}</div>
                        </div>
                        <div class="font-semibold">$ {{ number_format($order->price,0,',','.') }}</div>
                    </div>
                @empty
                    <p class="text-slate-500">Sin pedidos.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <h3 class="font-bold mb-4">Últimos cobros</h3>
            <div class="space-y-3">
                @forelse($latestPayments as $payment)
                    <div class="flex justify-between border-b pb-2">
                        <div>
                            <div class="font-semibold">{{ $payment->order->customer->name ?? '-' }}</div>
                            <div class="text-sm text-slate-500">{{ $payment->payment_date->format('d/m/Y') }} - {{ $payment->method }}</div>
                        </div>
                        <div class="font-semibold text-green-700">$ {{ number_format($payment->amount,0,',','.') }}</div>
                    </div>
                @empty
                    <p class="text-slate-500">Sin cobros.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
</x-app-layout>
