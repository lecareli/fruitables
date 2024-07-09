<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ env('APP_NAME') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <div class="w-full dark:bg-neutral-900 lg:ps-64">
            <div class="space-y-4 p-4 sm:space-y-6 sm:p-6">
                {{ $slot }}
            </div>
        </div>
    </body>

</html>
