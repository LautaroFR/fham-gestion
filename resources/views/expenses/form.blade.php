<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4"><label class="block mb-1">Fecha *</label><input type="date" name="expense_date" value="{{ old('expense_date', isset($expense) ? $expense->expense_date->format('Y-m-d') : date('Y-m-d')) }}" class="w-full border rounded p-2" required></div>
    <div class="mb-4"><label class="block mb-1">Categoría *</label><select name="category" class="w-full border rounded p-2" required>@foreach(['Melamina','Herrajes','Flete','Sueldos','Herramientas','Alquiler','Impuestos','Publicidad','Otro'] as $category)<option value="{{ $category }}" @selected(old('category', $expense->category ?? '') == $category)>{{ $category }}</option>@endforeach</select></div>
</div>
<div class="mb-4"><label class="block mb-1">Concepto *</label><input name="description" value="{{ old('description', $expense->description ?? '') }}" class="w-full border rounded p-2" required></div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="mb-4"><label class="block mb-1">Proveedor</label><input name="supplier" value="{{ old('supplier', $expense->supplier ?? '') }}" class="w-full border rounded p-2"></div>
    <div class="mb-4"><label class="block mb-1">Importe *</label><input type="number" step="0.01" name="amount" value="{{ old('amount', $expense->amount ?? '') }}" class="w-full border rounded p-2" required></div>
    <div class="mb-4"><label class="block mb-1">Medio de pago</label><select name="method" class="w-full border rounded p-2">@foreach(['Transferencia','Efectivo','Mercado Pago','Cheque','Tarjeta','Otro'] as $method)<option value="{{ $method }}" @selected(old('method', $expense->method ?? 'Transferencia') == $method)>{{ $method }}</option>@endforeach</select></div>
</div>
<div class="mb-4"><label class="block mb-1">Observaciones</label><textarea name="notes" class="w-full border rounded p-2">{{ old('notes', $expense->notes ?? '') }}</textarea></div>
