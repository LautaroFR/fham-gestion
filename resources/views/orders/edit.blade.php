<x-app-layout>
<div class="max-w-3xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-6">Editar pedido</h2>

    <form method="POST" action="{{ route('orders.update', $order) }}" class="bg-white p-6 rounded-xl shadow">
        @csrf
        @method('PUT')
        @include('orders.form')
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Guardar cambios</button>
        <a href="{{ route('orders.index') }}" class="ml-3 text-slate-600">Cancelar</a>
    </form>
</div>
</x-app-layout>
