<x-layout>
    <section class="px-6 py-8">

        <main class="max-w-8xl mx-auto space-y-6">
            {{-- News Item --}}
            <article class="max-w-8xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                <div class="col-span-4 lg:pt-14 mb-10">
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

                    <p class="mt-4 block text-gray-400 text-xs"></p>
                    <div class="flex items-center text-sm mt-4">
                        <img src="{{ asset('storage/uploads/images/feeds/' . $item->feed->logo) }}" alt="Feed Logo"
                             width="75" height="75">
                        <div class="ml-3 text-left">
                            <h5 class="ml-2 mt-2 font-bold">
                                <a href="/?source={{ $item->feed->feed_name }}">{{ $item->feed->feed_name }}</a>
                            </h5>

                            <h6 class="ml-2 mt-2 text-gray-400 text-xs"><span class="font-bold">Published:</span>
                                <time>{{$item->created_at->format('j.n.Y, g:i a')}}</time>
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="col-span-8">
                    <div class="hidden lg:flex justify-between mb-6">
                        <a href="/"
                           class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                            <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                                <g fill="none" fill-rule="evenodd">
                                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                    </path>
                                    <path class="fill-current"
                                          d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                    </path>
                                </g>
                            </svg>

                            Back to Posts
                        </a>

                        <div class="space-x-2">
                            <a href="/?category={{ $item->category->name }}"
                               class="px-3 py-1 border border-blue-500 rounded-full text-blue-500 text-xs uppercase font-semibold"
                               style="font-size: 10px">{{ $item->category->name }} </a>
                        </div>
                    </div>

                    <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                        {{ $item->title }}
                    </h1>

                    <div class="space-y-4 lg:text-lg leading-loose">
                        {!! $item->description !!}
                    </div>
                </div>

                {{-- Comments --}}

            </article>
        </main>

    </section>
</x-layout>
