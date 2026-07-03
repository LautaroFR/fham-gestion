<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4">
        <label class="block mb-1 font-medium">Cliente *</label>
        <select name="customer_id" class="w-full border rounded p-2" required>
            <option value="">Seleccionar cliente</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" @selected(old('customer_id', $order->customer_id ?? '') == $customer->id)>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
        @error('customer_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Fecha del pedido</label>
        <input name="order_date" type="date" value="{{ old('order_date', optional($order->order_date ?? now())->format('Y-m-d')) }}" class="w-full border rounded p-2">
        @error('order_date') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4">
        <label class="block mb-1 font-medium">Obra / Proyecto</label>
        <input name="project" value="{{ old('project', $order->project ?? '') }}" placeholder="Ej: Casa Alameda 424" class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Ambiente</label>
        <input name="room" value="{{ old('room', $order->room ?? '') }}" placeholder="Cocina, living, dormitorio..." class="w-full border rounded p-2">
    </div>
</div>

<div class="mb-4">
    <label class="block mb-1 font-medium">Mueble / Pedido *</label>
    <input name="title" value="{{ old('title', $order->title ?? '') }}" placeholder="Ej: Recibidor, box sommier, cocina..." class="w-full border rounded p-2" required>
    @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4">
        <label class="block mb-1 font-medium">Precio total *</label>
        <input name="price" type="number" step="0.01" value="{{ old('price', $order->price ?? '') }}" class="w-full border rounded p-2" required>
        @error('price') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Costo estimado</label>
        <input name="cost" type="number" step="0.01" value="{{ old('cost', $order->cost ?? 0) }}" class="w-full border rounded p-2">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4">
        <label class="block mb-1 font-medium">Fecha instalación / entrega</label>
        <input name="delivery_date" type="date" value="{{ old('delivery_date', optional($order->delivery_date ?? null)->format('Y-m-d')) }}" class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Estado</label>
        <select name="status" class="w-full border rounded p-2">
            @foreach(['Presupuesto','Señado','En producción','Listo','Instalado','Finalizado','Cancelado'] as $status)
                <option value="{{ $status }}" @selected(old('status', $order->status ?? 'Presupuesto') == $status)>
                    {{ $status }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="mb-4">
    <label class="block mb-1 font-medium">Observaciones</label>
    <textarea name="notes" rows="4" class="w-full border rounded p-2">{{ old('notes', $order->notes ?? '') }}</textarea>
</div>
