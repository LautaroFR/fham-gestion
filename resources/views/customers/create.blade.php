<x-app-layout>
<div class="max-w-3xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-6">Nuevo cliente</h2>

    <form method="POST" action="{{ route('customers.store') }}" class="bg-white p-6 rounded shadow">
        @csrf

        @include('customers.form')

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Guardar
        </button>

        <a href="{{ route('customers.index') }}" class="ml-3">
            Cancelar
        </a>
    </form>
</div>
</x-app-layout>