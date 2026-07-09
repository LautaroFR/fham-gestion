<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        try {
            Mail::raw(
                "Se creó una nueva cuenta en FHAM Gestión.\n\n".
                "Nombre: {$user->name}\n".
                "Email: {$user->email}\n".
                "Fecha: ".now()->format('d/m/Y H:i'),
                function ($message) use ($user) {
                    $message->to('ventas@fham.com.ar')
                        ->subject('Nueva cuenta creada en FHAM Gestión: '.$user->email);
                }
            );
        } catch (\Throwable $exception) {
            Log::warning('No se pudo enviar aviso de nuevo usuario', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $exception->getMessage(),
            ]);
        }

        return redirect()
            ->route('login')
            ->with('status', 'Cuenta creada correctamente. Ya podés iniciar sesión.');
    }
}
