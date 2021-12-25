@props(['items'])
<x-items.featured-item-card :item="$items[0]"/>

@include('items._header', ['header_string' => 'Latest News Feed Items'])

@if($items->count() > 1)
    <div class="lg:grid lg:grid-cols-6">
        @foreach($items->skip(1) as $item)
            <x-items.item-card
                :item="$item"
                class="col-span-2">
                {{--{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2'}}--}}
            </x-items.item-card>
        @endforeach
    </div>
@endif
