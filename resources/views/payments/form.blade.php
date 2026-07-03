<div class="mb-4">
    <label class="block mb-1">Pedido *</label>
    <select name="order_id" class="w-full border rounded p-2">
        <option value="">Seleccionar pedido</option>
        @foreach($orders as $order)
            <option value="{{ $order->id }}"
                @selected(old('order_id', $payment->order_id ?? '') == $order->id)>
                {{ optional($order->order_date)->format('d/m/Y') }} · {{ $order->customer->name }} · {{ $order->title }} · Saldo: $ {{ number_format($order->balance,0,',','.') }}
            </option>
        @endforeach
    </select>
    @error('order_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4">
        <label class="block mb-1">Fecha de cobro *</label>
        <input name="payment_date" type="date"
               value="{{ old('payment_date', isset($payment->payment_date) && $payment->payment_date ? $payment->payment_date->format('Y-m-d') : now()->format('Y-m-d')) }}"
               class="w-full border rounded p-2">
        @error('payment_date') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label class="block mb-1">Importe *</label>
        <input name="amount" type="number" step="0.01" value="{{ old('amount', $payment->amount ?? '') }}" class="w-full border rounded p-2">
        @error('amount') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4">
        <label class="block mb-1">Medio de pago</label>
        <select name="method" class="w-full border rounded p-2">
            @foreach(['Transferencia','Efectivo','Mercado Pago','Cheque','Tarjeta','Otro'] as $method)
                <option value="{{ $method }}" @selected(old('method', $payment->method ?? 'Transferencia') == $method)>
                    {{ $method }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Referencia / comprobante</label>
        <input name="reference" value="{{ old('reference', $payment->reference ?? '') }}" class="w-full border rounded p-2">
    </div>
</div>

<div class="mb-4">
    <label class="block mb-1">Observaciones</label>
    <textarea name="notes" class="w-full border rounded p-2">{{ old('notes', $payment->notes ?? '') }}</textarea>
</div>
