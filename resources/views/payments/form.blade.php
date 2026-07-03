<div class="mb-4">
    <label class="block mb-1">Pedido *</label>
    <select name="order_id" class="w-full border rounded p-2" required>
        <option value="">Seleccionar pedido</option>
        @foreach($orders as $order)
            <option value="{{ $order->id }}" @selected(old('order_id', $payment->order_id ?? $selectedOrder ?? '') == $order->id)>
                {{ $order->customer->name }} - {{ $order->title }} - Saldo: $ {{ number_format($order->balance,0,',','.') }}
            </option>
        @endforeach
    </select>
    @error('order_id')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4"><label class="block mb-1">Fecha *</label><input type="date" name="payment_date" value="{{ old('payment_date', isset($payment) ? $payment->payment_date->format('Y-m-d') : date('Y-m-d')) }}" class="w-full border rounded p-2" required>@error('payment_date')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror</div>
    <div class="mb-4"><label class="block mb-1">Importe *</label><input type="number" step="0.01" name="amount" value="{{ old('amount', $payment->amount ?? '') }}" class="w-full border rounded p-2" required>@error('amount')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4"><label class="block mb-1">Medio de pago</label><select name="method" class="w-full border rounded p-2">@foreach(['Transferencia','Efectivo','Mercado Pago','Cheque','Tarjeta','Otro'] as $method)<option value="{{ $method }}" @selected(old('method', $payment->method ?? 'Transferencia') == $method)>{{ $method }}</option>@endforeach</select></div>
    <div class="mb-4"><label class="block mb-1">Comprobante / referencia</label><input name="reference" value="{{ old('reference', $payment->reference ?? '') }}" class="w-full border rounded p-2"></div>
</div>
<div class="mb-4"><label class="block mb-1">Observaciones</label><textarea name="notes" class="w-full border rounded p-2">{{ old('notes', $payment->notes ?? '') }}</textarea></div>
