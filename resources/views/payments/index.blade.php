<x-app-layout>
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div><h2 class="text-2xl font-bold">Cobros</h2><p class="text-slate-500">Pagos recibidos de clientes</p></div>
        <a href="{{ route('payments.create') }}" class="px-4 py-2 bg-green-600 text-white rounded">+ Nuevo Cobro</a>
    </div>
    @if(session('success'))<div class="bg-green-100 border border-green-300 rounded p-3">{{ session('success') }}</div>@endif
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100"><tr><th class="p-3 text-left">Fecha</th><th class="p-3 text-left">Cliente</th><th class="p-3 text-left">Pedido</th><th class="p-3 text-left">Medio</th><th class="p-3 text-right">Importe</th><th class="p-3 text-right">Acciones</th></tr></thead>
            <tbody>
            @forelse($payments as $payment)
                <tr class="border-b hover:bg-slate-50">
                    <td class="p-3">{{ $payment->payment_date->format('d/m/Y') }}</td>
                    <td class="p-3">{{ $payment->order->customer->name ?? '-' }}</td>
                    <td class="p-3">{{ $payment->order->title ?? '-' }}</td>
                    <td class="p-3">{{ $payment->method }}</td>
                    <td class="p-3 text-right font-semibold text-green-700">$ {{ number_format($payment->amount,0,',','.') }}</td>
                    <td class="p-3 text-right">
                        <a href="{{ route('payments.edit',$payment) }}" class="text-blue-600 hover:underline">Editar</a>
                        <form method="POST" action="{{ route('payments.destroy',$payment) }}" class="inline">@csrf @method('DELETE')<button onclick="return confirm('¿Eliminar cobro?')" class="text-red-600 ml-3 hover:underline">Eliminar</button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center p-10 text-slate-500">No hay cobros cargados.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $payments->links() }}
</div>
</x-app-layout>
