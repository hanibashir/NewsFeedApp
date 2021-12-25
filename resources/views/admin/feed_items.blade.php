@extends('adminlte::page')

@section('title', ' Items')

@section('content_header')

@stop

@section('content')

    @include('admin.inc.messages')


    <div class="card">
        <div class="card-header">
            <div class="row">
                <h5>Items from: {{ $feed_name->feed_name }}</h5>
                <a type="button" href="feeds/create" class="ml-auto mr-5 btn btn-primary btn-sm card-header-pills">
                    <h5>Add New Item</h5></a>

            </div>
        </div>

        <table class="table table-responsive table-hover">

            <thead>
            <tr>
                <th style="width: 7%">Thumbnail</th>
                <th style="width: 35%">Title</th>
                <th style="width: 7%">Category</th>
                <th style="width: 7%">Link</th>
                <th style="width: 7%">Edit</th>
            </tr>
            </thead>

            <tbody>
            @foreach($feed_items as $item)
                <tr>

                    @if(!$item->thumbnail == '')
                        <td><img src="{{ asset('storage/uploads/images/items/' . $item->thumbnail) }}" width="75" height="75">
                        </td>
                    @else
                        <td><img src="{{ asset('storage/uploads/images/feeds/' . $item->feed->logo) }}" width="75" height="75">
                        </td>
                    @endif
                    <td><a href="{{ url('/') }}/items/{{$item->id}}"
                           target="_blank">{{html_entity_decode(strip_tags($item->title)) }}</a></td>

                    @if(isset($item->category->id))
                        <td>
                            <a href="{{ url('/admin') }}/categories/{{$item->category->id}}/items">{{$item->category->name}}</a>
                        </td>
                    @else
                        <td>Not Available</td>
                    @endif
                    <td><a href="{{$item->url }}">Link</a></td>

                    <td>
                        <div class="row">
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-warning"
                               href="{{ url('/admin') }}/items/{{ $item->id }}/edit"><i class="fa fa-edit"></i> </a>

                            <form action="{{ url('/admin') }}/items/{{ $item->id }}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button onclick="return confirm('Are you sure?')"
                                        class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger">
                                    <i
                                        class="fa fa-trash"></i></button>
                            </form>
                        </div>

                    </td>

                </tr>

            @endforeach
            </tbody>
        </table>

    </div>

@stop

