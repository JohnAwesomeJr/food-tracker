<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/flatly/bootstrap.min.css" integrity="sha384-qF/QmIAj5ZaYFAeQcrQ6bfVMAh4zZlrGwTPY7T/M+iTTLJqJBJjwwnsE5Y0mV7QK" crossorigin="anonymous">
</head>

<body>
    <style>
        #production-banner {
            position: fixed;
            border-radius: 5px;
            padding: 20px;
            bottom: 0px;
            right: 0px;
        }

        .banner-style-pro {
            color: white;
            background: red;
        }

        .banner-style-loc {
            color: gray;
            background: lightgray;
        }
        .btn-danger{
            color: darkred;
        }
    </style>
    @if (env('APP_ENV') === 'production')
        <p id="production-banner" class="banner-style-pro">This is the production environment.</p>
    @else
        <div class=" animated infinite bounce">
            <p id="production-banner" class="banner-style-loc">This is not the production environment.</p>
        </div>
    @endif

    <x-app-layout>
        {{-- <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot> --}}

        <div class="container">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>

</html>
