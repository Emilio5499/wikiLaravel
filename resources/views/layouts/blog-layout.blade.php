<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex h-screen flex-col bg-slate-100 selection:bg-sky-600 selection:text-sky-50 dark:bg-slate-950">
@include('layouts.blog-navigation')

@session('status')
<div class="bg-green-600 p-4 text-xl text-green-50 dark:bg-green-800">
    {{ $value }}
</div>
@endsession

<main class="flex-1 p-4">
    {{ $slot }}
</main>

<footer class="py-10 px-4">
    <div
        class="mx-auto flex max-w-6xl flex-col items-center space-y-4 md:flex-row md:justify-between md:space-y-0"
    >
        <div
            class="text-center text-sm text-slate-600 dark:text-slate-400"
        >
        </div>
        <div class="flex space-x-4">
            <a href="#">
                <svg
                    class="w-6 fill-current text-slate-600 duration-300 hover:text-[#1877F2] dark:text-slate-400 dark:hover:text-[#1877F2]"
                    role="img"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                </svg>
            </a>
            <a href="#">
                <svg
                    class="w-6 fill-current text-slate-600 duration-300 hover:text-[#1DA1F2] dark:text-slate-400 dark:hover:text-[#1DA1F2]"
                    role="img"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >

                </svg
                ></a>
            <a href="#">
                <svg
                    class="w-6 fill-current text-slate-600 duration-300 hover:text-[#E4405F] dark:text-slate-400 dark:hover:text-[#E4405F]"
                    role="img"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >

                </svg>
            </a>
            <a href="#">
                <svg
                    class="w-6 fill-current text-slate-600 duration-300 hover:text-[#181717] dark:text-slate-400 dark:hover:text-slate-200"
                    role="img"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                </svg>
            </a>
            <a href="#">
                <svg
                    class="w-6 fill-current text-slate-600 duration-300 hover:text-[#25D366] dark:text-slate-400 dark:hover:text-[#25D366]"
                    role="img"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                </svg>
            </a>
        </div>
    </div>
</footer>

</body>
</html>
