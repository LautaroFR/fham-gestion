<div class="mb-4">
    <label class="block mb-1">Nombre *</label>
    <input name="name" value="{{ old('name', $customer->name ?? '') }}" class="w-full border rounded p-2">
    @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block mb-1">Teléfono</label>
    <input name="phone" value="{{ old('phone', $customer->phone ?? '') }}" class="w-full border rounded p-2">
</div>

<div class="mb-4">
    <label class="block mb-1">Email</label>
    <input name="email" value="{{ old('email', $customer->email ?? '') }}" class="w-full border rounded p-2">
</div>

<div class="mb-4">
    <label class="block mb-1">Dirección</label>
    <input name="address" value="{{ old('address', $customer->address ?? '') }}" class="w-full border rounded p-2">
</div>

<div class="mb-4">
    <label class="block mb-1">Observaciones</label>
    <textarea name="notes" class="w-full border rounded p-2">{{ old('notes', $customer->notes ?? '') }}</textarea>
</div>