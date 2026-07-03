<x-app-layout>
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div><h2 class="text-2xl font-bold">Gastos</h2><p class="text-slate-500">Egresos de caja</p></div>
        <a href="{{ route('expenses.create') }}" class="px-4 py-2 bg-red-600 text-white rounded">+ Nuevo Gasto</a>
    </div>
    @if(session('success'))<div class="bg-green-100 border border-green-300 rounded p-3">{{ session('success') }}</div>@endif
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-100"><tr><th class="p-3 text-left">Fecha</th><th class="p-3 text-left">Categoría</th><th class="p-3 text-left">Concepto</th><th class="p-3 text-left">Proveedor</th><th class="p-3 text-right">Importe</th><th class="p-3 text-right">Acciones</th></tr></thead>
            <tbody>
            @forelse($expenses as $expense)
                <tr class="border-b hover:bg-slate-50">
                    <td class="p-3">{{ $expense->expense_date->format('d/m/Y') }}</td><td class="p-3">{{ $expense->category }}</td><td class="p-3">{{ $expense->description }}</td><td class="p-3">{{ $expense->supplier }}</td><td class="p-3 text-right font-semibold text-red-600">$ {{ number_format($expense->amount,0,',','.') }}</td>
                    <td class="p-3 text-right"><a href="{{ route('expenses.edit',$expense) }}" class="text-blue-600 hover:underline">Editar</a><form method="POST" action="{{ route('expenses.destroy',$expense) }}" class="inline">@csrf @method('DELETE')<button onclick="return confirm('¿Eliminar gasto?')" class="text-red-600 ml-3 hover:underline">Eliminar</button></form></td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center p-10 text-slate-500">No hay gastos cargados.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $expenses->links() }}
</div>
</x-app-layout>
