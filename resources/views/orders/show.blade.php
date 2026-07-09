<x-app-layout>
<div class="max-w-7xl mx-auto py-6">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl font-bold">{{ $order->title }}</h1>
            <p class="text-gray-500">
                {{ $order->customer->name }} · {{ optional($order->order_date)->format('d/m/Y') }}
            </p>
            @if($order->project)
                <p class="text-gray-500">Obra: {{ $order->project }}</p>
            @endif
        </div>

        <div class="flex gap-2">
            <a href="{{ route('payments.create', ['order_id' => $order->id]) }}"
               class="inline-flex items-center px-4 py-2 bg-green-600 rounded-md text-sm font-semibold text-white hover:bg-green-700">
                + Agregar cobro
            </a>

            <a href="{{ route('orders.edit', $order) }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 rounded-md text-sm font-semibold text-white hover:bg-blue-700">
                Editar
            </a>

            <form method="POST" action="{{ route('orders.destroy', $order) }}" class="inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('¿Eliminar el pedido y TODOS sus cobros?')"
                        class="inline-flex items-center px-4 py-2 bg-red-600 rounded-md text-sm font-semibold text-white hover:bg-red-700">
                    Eliminar
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 rounded p-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white shadow rounded p-5">
            <div class="text-gray-500">Precio</div>
            <div class="text-3xl font-bold">{{ $order->currencySymbol() }} {{ number_format($order->price,0,',','.') }}</div>
            @if($order->currency === 'USD' && $order->usd_rate)
                <div class="text-xs text-gray-500">Ref dólar: $ {{ number_format($order->usd_rate,0,',','.') }}</div>
            @endif
        </div>

        <div class="bg-white shadow rounded p-5">
            <div class="text-gray-500">Cobrado</div>
            <div class="text-3xl font-bold text-green-700">{{ $order->currencySymbol() }} {{ number_format($order->collected,0,',','.') }}</div>
        </div>

        <div class="bg-white shadow rounded p-5">
            <div class="text-gray-500">Saldo</div>
            <div class="text-3xl font-bold {{ $order->balance > 0 ? 'text-red-600' : 'text-green-700' }}">
                {{ $order->currencySymbol() }} {{ number_format($order->balance,0,',','.') }}
            </div>
        </div>

        <div class="bg-white shadow rounded p-5">
            <div class="text-gray-500">Estado cobro</div>
            <div class="text-3xl font-bold">{{ $order->payment_status }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded shadow">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-xl font-bold">Historial de cobros</h2>
                <a href="{{ route('payments.create', ['order_id' => $order->id]) }}" class="text-blue-600 hover:underline">
                    Agregar cobro
                </a>
            </div>

            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Fecha</th>
                        <th class="p-3 text-left">Medio</th>
                        <th class="p-3 text-left">Referencia</th>
                        <th class="p-3 text-right">Importe</th>
                        <th class="p-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($order->payments as $payment)
                    <tr class="border-b">
                        <td class="p-3">{{ $payment->payment_date->format('d/m/Y') }}</td>
                        <td class="p-3">{{ $payment->method }}</td>
                        <td class="p-3">{{ $payment->reference }}</td>
                        <td class="p-3 text-right">{{ $payment->currencySymbol() }} {{ number_format($payment->amount,0,',','.') }}</td>
                        <td class="p-3 text-right">
                            <a href="{{ route('payments.edit', $payment) }}" class="text-blue-600 hover:underline">Editar</a>

                            <form method="POST" action="{{ route('payments.destroy', $payment) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('¿Eliminar cobro?')" class="text-red-600 ml-3 hover:underline">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-8 text-gray-500">
                            Este pedido todavía no tiene cobros.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-white rounded shadow p-5">
            <h2 class="text-xl font-bold mb-4">Detalle</h2>

            <div class="mb-3">
                <div class="text-gray-500">Cliente</div>
                <a href="{{ route('customers.show', $order->customer) }}" class="text-blue-600 hover:underline">
                    {{ $order->customer->name }}
                </a>
            </div>

            <div class="mb-3">
                <div class="text-gray-500">Moneda</div>
                <div>{{ $order->currency === 'USD' ? 'U$D' : '$' }}</div>
            </div>

            <div class="mb-3">
                <div class="text-gray-500">Ambiente</div>
                <div>{{ $order->room ?: '-' }}</div>
            </div>

            <div class="mb-3">
                <div class="text-gray-500">Estado producción</div>
                <div>{{ $order->status }}</div>
            </div>

            <div class="mb-3">
                <div class="text-gray-500">Entrega / instalación</div>
                <div>{{ $order->delivery_date ? $order->delivery_date->format('d/m/Y') : '-' }}</div>
            </div>

            <div class="mb-3">
                <div class="text-gray-500">Notas</div>
                <div>{{ $order->notes ?: '-' }}</div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
