<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!-- El atributo 'lang' se establece según la configuración regional de la aplicación Laravel -->

    <head>
        <meta charset="utf-8">
        <!-- Configura la codificación de caracteres como UTF-8 -->

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Define el viewport para hacer que el sitio sea responsive -->

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Inserta el token CSRF de Laravel para proteger contra ataques de falsificación de solicitudes -->

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Define el título de la página, usando el nombre de la aplicación o "Laravel" como valor predeterminado -->

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Conexión previa y carga de la fuente 'Figtree' desde Bunny Fonts -->

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Usa Vite para compilar y enlazar los archivos CSS y JS en la carpeta de recursos de la aplicación -->
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')
            <!-- Incluye el archivo de navegación desde la carpeta 'layouts' -->

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                        <!-- Muestra el encabezado de la página si está definido, como un título o subtítulo -->
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
                <!-- Espacio para el contenido principal de la página que se incluirá en esta plantilla -->
            </main>
        </div>
    </body>
</html>
