<x-app-layout>
<div class="max-w-3xl mx-auto py-6"><h2 class="text-2xl font-bold mb-6">Editar gasto</h2><form method="POST" action="{{ route('expenses.update',$expense) }}" class="bg-white p-6 rounded-xl shadow">@csrf @method('PUT') @include('expenses.form')<button class="bg-red-600 text-white px-4 py-2 rounded">Guardar cambios</button><a href="{{ route('expenses.index') }}" class="ml-3">Cancelar</a></form></div>
</x-app-layout>
