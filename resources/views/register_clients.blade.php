<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ str_replace("http", "https", asset('css/app.css')) }}">
    <link rel="stylesheet" href="{{ str_replace("http", "https", asset('css/style.css')) }}">


    <!-- Scripts -->
    <script src="{{ str_replace("http", "https", asset('js/app.js')) }}" defer></script>
</head>
<body>
    <form class="w-full max-w-sm flex h-screen flex-col justify-center m-auto" action="{{ str_replace("http", "https", route('setting.createClients')) }}" method="post">
        @csrf
        <div class="p-7 shadow-2xl">
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                        Email
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="email"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                        id="inline-full-name" type="email" value="">
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
                        Телефон
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="phone"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                        id="inline-password" type="tel" placeholder="+79787468066">
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <label class="block text-gray-500 font-bold">
                    <input class="mr-2 leading-tight" type="checkbox">
                    <span class="text-sm">
                    Согласен с политикой безопасности
                  </span>
                </label>
            </div>
            <div class="flex flex-col justify-center">
                    <button
                        class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                        type="submit">
                        Перейти в телеграм бота
                    </button>
            </div>
        </div>
    </form>
</body>
</html>
