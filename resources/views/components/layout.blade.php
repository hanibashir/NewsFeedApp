<!doctype html>

<title>News Feed App</title>
<link href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">

<style>
    html {
        scroll-behavior: smooth;
    }
</style>

<body style="font-family: open sans, sans-serif">
<section class="px-6 py-8">
    <nav class="flex justify-between items-center">
        <div>
            <a href="/">
                <img src="{{ asset('storage/uploads/images/news-logo.png') }}"
                     alt="News App Logo" width="150" height="16" class="rounded-xl">
            </a>
        </div>

        @include('items._header', ['header_string' => 'News Feed App'])

        <div class="flex items-center md:mt-0 mt-8">
            @auth

                <a href="/admin"
                   class="bg-blue-800 ml-3 rounded-2xl text-xs font-semibold text-white uppercase py-3 px-7">Dashboard</a>

            @else
                <a href="/register" class="text-xs font-bold uppercase">Register</a>
                <a href="/login" class="ml-4 mr-2 text-xs font-bold uppercase">Login</a>

            @endauth
        </div>
    </nav>

    {{ $slot }}


    <footer class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">

    </footer>
</section>

</body>
