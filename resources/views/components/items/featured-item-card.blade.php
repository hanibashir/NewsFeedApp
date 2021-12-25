@props(['item'])
<article
    class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
    <div class="py-6 px-5 lg:flex">
        <div class="flex-1 lg:mr-8">
            @if(!$item->thumbnail == '')
                <td><img src="{{ asset('storage/uploads/images/items/' . $item->thumbnail) }}"
                         alt="News Item Image" class="rounded-xl" width="450" height="250">
                </td>
            @else
                @if(isset($item->feed->logo))
                    <td><img src="{{ asset('storage/uploads/images/feeds/' . $item->feed->logo) }}"
                             alt="News Item Image" class="rounded-xl" width="450" height="250">
                    </td>
                @endif
            @endif
        </div>

        <div class="flex-1 flex flex-col justify-between">
            <header class="mt-8 lg:mt-0">
                <div class="space-x-2">
                    <a href="/?category={{ $item->category->name }}"
                       class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                       style="font-size: 10px">{{ $item->category->name }}</a>
                </div>

                <div class="mt-4">
                    <h1 class="text-3xl">
                        <a href="/items/{{ $item->id }}">
                            {{ $item->title }}
                        </a>
                    </h1>

                    <div class="flex items-center space-x-1">
                        <div>
                            <span class="mt-2 block text-gray-400 text-xs">Published: <time>{{$item->created_at->diffForHumans()}}</time></span>
                        </div>
                    </div>
                </div>
            </header>

            <div class="text-sm mt-2 space-y-4"> {!! substr($item->description, 0, 250)  !!} </div>

            <footer class="flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                    <img src="{{ asset('storage/uploads/images/feeds/' . $item->feed->logo) }}" alt="Feed Logo"
                         width="75" height="75">
                    <div class="ml-3">
                        <h5 class="font-bold">
                            <a href="/?source={{ $item->feed->feed_name }}">{{ $item->feed->feed_name }}</a>
                        </h5>
                    </div>
                </div>

                <div class="hidden lg:block">
                    <a href="/items/{{ $item->id }}"
                       class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8">
                        Read More</a>
                </div>
            </footer>
        </div>
    </div>
</article>
