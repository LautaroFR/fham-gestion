<x-app-layout>
<div class="max-w-3xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-6">Nuevo cobro</h2>
    <form method="POST" action="{{ route('payments.store') }}" class="bg-white p-6 rounded-xl shadow">
        @csrf
        @include('payments.form')
        <button class="bg-green-600 text-white px-4 py-2 rounded">Guardar cobro</button>
        <a href="{{ route('payments.index') }}" class="ml-3">Cancelar</a>
    </form>
</div>
</x-app-layout>
