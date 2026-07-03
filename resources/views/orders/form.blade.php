<div class="mb-4">
    <label class="block mb-1">Cliente *</label>
    <select name="customer_id" class="w-full border rounded p-2">
        <option value="">Seleccionar cliente</option>
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}"
                @selected(old('customer_id', $order->customer_id ?? '') == $customer->id)>
                {{ $customer->name }}
            </option>
        @endforeach
    </select>
    @error('customer_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block mb-1">Obra / Proyecto</label>
    <input name="project" value="{{ old('project', $order->project ?? '') }}" class="w-full border rounded p-2">
</div>

<div class="mb-4">
    <label class="block mb-1">Ambiente</label>
    <input name="room" value="{{ old('room', $order->room ?? '') }}" placeholder="Cocina, placard, vestidor..." class="w-full border rounded p-2">
</div>

<div class="mb-4">
    <label class="block mb-1">Mueble / Pedido *</label>
    <input name="title" value="{{ old('title', $order->title ?? '') }}" placeholder="Box sommier, cocina, placard..." class="w-full border rounded p-2">
    @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4">
        <label class="block mb-1">Precio total *</label>
        <input name="price" type="number" step="0.01" value="{{ old('price', $order->price ?? '') }}" class="w-full border rounded p-2">
        @error('price') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label class="block mb-1">Costo estimado</label>
        <input name="cost" type="number" step="0.01" value="{{ old('cost', $order->cost ?? 0) }}" class="w-full border rounded p-2">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4">
        <label class="block mb-1">Fecha instalación / entrega</label>
        <input name="delivery_date" type="date" value="{{ old('delivery_date', $order->delivery_date ?? '') }}" class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Estado</label>
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
    <label class="block mb-1">Observaciones</label>
    <textarea name="notes" class="w-full border rounded p-2">{{ old('notes', $order->notes ?? '') }}</textarea>
</div>