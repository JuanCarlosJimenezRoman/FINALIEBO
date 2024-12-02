<x-guest-layout>
    <!-- Estado de sesión para mostrar mensajes de éxito o estado, si los hay -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Formulario para iniciar sesión -->
    <form method="POST" action="{{ route('login') }}">
        <!-- Token CSRF para proteger el formulario contra ataques de falsificación de solicitudes -->
        @csrf

        <!-- Campo de correo electrónico -->
        <div>
            <!-- Etiqueta para el campo de correo electrónico -->
            <x-input-label for="email" :value="__('Email')" />

            <!-- Campo de entrada para el correo electrónico. Permite al usuario ingresar su email y el valor
                 permanece si ocurre algún error al enviar el formulario. Se desactiva el autocompletado -->
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="off" />

            <!-- Muestra errores de validación para el campo de correo electrónico, si los hay -->
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Campo de contraseña -->
        <div class="mt-4">
            <!-- Etiqueta para el campo de contraseña -->
            <x-input-label for="password" :value="__('Password')" />

            <!-- Campo de entrada para la contraseña, configurado para ocultar los caracteres ingresados -->
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />

            <!-- Muestra errores de validación para el campo de contraseña, si los hay -->
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Opción "Recuérdame" -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <!-- Checkbox para recordar al usuario en futuras sesiones -->
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Enlace para restablecer contraseña y botón de inicio de sesión -->
        <div class="flex items-center justify-end mt-4">
            <!-- Verifica si existe la ruta de restablecimiento de contraseña y muestra el enlace si es el caso -->
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <!-- Botón principal para enviar el formulario e iniciar sesión -->
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
