<x-app-layout>

<div class="max-w-7xl mx-auto py-6">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h1 class="text-3xl font-bold">

                {{ $customer->name }}

            </h1>

            <p class="text-gray-500">

                {{ $customer->phone }}

            </p>

            <p class="text-gray-500">

                {{ $customer->email }}

            </p>

        </div>

        <a href="{{ route('customers.edit',$customer) }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">

            Editar Cliente

        </a>

    </div>

    <div class="grid grid-cols-3 gap-5 mb-8">

        <div class="bg-white shadow rounded p-5">

            <div class="text-gray-500">

                Pedidos

            </div>

            <div class="text-4xl font-bold">

                {{ $customer->orders_count }}

            </div>

        </div>

        <div class="bg-white shadow rounded p-5">

            <div class="text-gray-500">

                Facturado

            </div>

            <div class="text-4xl font-bold">

                $ {{ number_format($customer->total_sold,0,',','.') }}

            </div>

        </div>

        <div class="bg-white shadow rounded p-5">

            <div class="text-gray-500">

                Pendiente

            </div>

            <div class="text-4xl font-bold text-red-600">

                $ {{ number_format($customer->pending,0,',','.') }}

            </div>

        </div>

    </div>

    <div class="bg-white rounded shadow">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-left">Fecha</th>

                    <th class="p-3 text-left">Pedido</th>

                    <th class="p-3 text-right">Precio</th>

                    <th class="p-3 text-left">Estado</th>

                </tr>

            </thead>

            <tbody>

            @forelse($customer->orders as $order)

                <tr class="border-b">

                    <td class="p-3">

                        {{ $order->created_at->format('d/m/Y') }}

                    </td>

                    <td class="p-3">

                        {{ $order->title }}

                    </td>

                    <td class="p-3 text-right">

                        $ {{ number_format($order->price,0,',','.') }}

                    </td>

                    <td class="p-3">

                        {{ $order->status }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4" class="text-center p-8">

                        Este cliente todavía no tiene pedidos.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>