<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FHAM Gestión</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100 text-slate-900">
<div class="min-h-screen flex">
    <aside class="w-64 bg-slate-950 text-white hidden md:flex md:flex-col">
        <div class="p-6 border-b border-slate-800">
            <div class="text-xl font-bold">FHAM</div>
            <div class="text-xs text-slate-400">Gestión</div>
        </div>

        <nav class="flex-1 p-4 space-y-1 text-sm">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-slate-800 {{ request()->routeIs('dashboard') ? 'bg-slate-800' : '' }}">Dashboard</a>
            <a href="{{ route('customers.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 {{ request()->routeIs('customers.*') ? 'bg-slate-800' : '' }}">Clientes</a>
            <a href="{{ route('orders.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 {{ request()->routeIs('orders.*') ? 'bg-slate-800' : '' }}">Pedidos</a>
            <a href="{{ route('payments.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 {{ request()->routeIs('payments.*') ? 'bg-slate-800' : '' }}">Cobros</a>
            <a href="{{ route('expenses.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 {{ request()->routeIs('expenses.*') ? 'bg-slate-800' : '' }}">Gastos</a>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 rounded hover:bg-slate-800 text-sm">Cerrar sesión</button>
            </form>
        </div>
    </aside>

    <div class="flex-1 min-w-0">
        <header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between">
            <div>
                <h1 class="font-bold text-lg">FHAM Gestión</h1>
                <p class="text-xs text-slate-500">Sistema interno</p>
            </div>
            <div class="flex gap-2 text-sm">
                <a href="{{ route('customers.create') }}" class="px-3 py-2 bg-slate-900 text-white rounded">+ Cliente</a>
                <a href="{{ route('orders.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">+ Pedido</a>
                <a href="{{ route('payments.create') }}" class="px-3 py-2 bg-green-600 text-white rounded">+ Cobro</a>
            </div>
        </header>

        <main class="p-6">
            {{ $slot }}
        </main>
    </div>
</div>
</body>
</html>
