<x-app-layout>
<div class="max-w-3xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-6">Registrar cobro</h2>

    @if(isset($selectedOrder) && $selectedOrder)
        <div class="bg-blue-50 border border-blue-200 rounded p-4 mb-4">
            <div class="font-semibold">{{ $selectedOrder->customer->name }} · {{ $selectedOrder->title }}</div>
            <div class="text-sm text-gray-600">
                Precio: $ {{ number_format($selectedOrder->price,0,',','.') }} ·
                Cobrado: $ {{ number_format($selectedOrder->collected,0,',','.') }} ·
                Saldo: $ {{ number_format($selectedOrder->balance,0,',','.') }}
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('payments.store') }}" class="bg-white p-6 rounded shadow">
        @csrf

        @include('payments.form')

        <button class="bg-green-600 text-white px-4 py-2 rounded">Guardar cobro</button>

        @if(isset($selectedOrder) && $selectedOrder)
            <a href="{{ route('orders.show', $selectedOrder) }}" class="ml-3">Cancelar</a>
        @else
            <a href="{{ route('payments.index') }}" class="ml-3">Cancelar</a>
        @endif
    </form>
</div>
</x-app-layout>
