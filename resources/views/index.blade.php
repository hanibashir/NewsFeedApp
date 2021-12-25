<x-layout>

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

        @if($items->count())

        <x-items.items-grid :items="$items"></x-items.items-grid>

        {{ $items->links() }}

        @else
        <div class="text-center">
            <strong>No posts available at this time</strong>
            <p>Go to <a href="/admin" style="color:blue;">Dashboard</a> and add feed sources url then run command: </p>
            <i> php artisan grab:fresh</i> <br>
            <p>to grab news from sources.</p>
        </div>

        @endif

    </main>
</x-layout>
