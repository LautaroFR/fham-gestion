<x-app-layout>
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold">Clientes</h2>
            <p class="text-slate-500">{{ $customers->total() }} cliente(s)</p>
        </div>
        <a href="{{ route('customers.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Nuevo Cliente</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 rounded p-3">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100">
                <tr>
                    <th class="p-3 text-left">Cliente</th>
                    <th class="p-3 text-left">Teléfono</th>
                    <th class="p-3 text-center">Pedidos</th>
                    <th class="p-3 text-right">Facturado</th>
                    <th class="p-3 text-right">Cobrado</th>
                    <th class="p-3 text-right">Pendiente</th>
                    <th class="p-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($customers as $customer)
                <tr class="border-b hover:bg-slate-50">
                    <td class="p-3 font-semibold"><a href="{{ route('customers.show',$customer) }}" class="text-blue-600 hover:underline">{{ $customer->name }}</a></td>
                    <td class="p-3">{{ $customer->phone }}</td>
                    <td class="p-3 text-center">{{ $customer->orders_count }}</td>
                    <td class="p-3 text-right">$ {{ number_format($customer->total_sold,0,',','.') }}</td>
                    <td class="p-3 text-right text-green-700">$ {{ number_format($customer->total_collected,0,',','.') }}</td>
                    <td class="p-3 text-right font-semibold text-red-600">$ {{ number_format($customer->pending,0,',','.') }}</td>
                    <td class="p-3 text-right">
                        <a href="{{ route('customers.edit',$customer) }}" class="text-blue-600 hover:underline">Editar</a>
                        <form method="POST" action="{{ route('customers.destroy',$customer) }}" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('¿Eliminar cliente?')" class="text-red-600 ml-4 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center p-10 text-slate-500">No hay clientes cargados.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $customers->links() }}
</div>
</x-app-layout>
