@extends('adminlte::page')

@section('title', ' Feed Sources')

@section('content_header')

@stop

@section('content')

    @include('admin.inc.messages')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <h3>Feed Sources</h3>
                <a type="button" href="feeds/create" class="ml-auto mr-5 btn btn-primary btn-sm card-header-pills">
                    <h5>Add New Feed Source</h5></a>

            </div>
        </div>
        <div class="card-body">
        @if(count($feeds) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Items Limit</th>
                    <th>Link</th>
                    <th>Edit</th>
                </tr>

                </thead>
                <tbody>
                @foreach($feeds as $feed)
                    <tr>
                        <td><img src="{{ asset('storage/uploads/images/feeds/' . $feed->logo) }}" width="75" height="75">
                        </td>
                        <td><a href=" feeds/{{ $feed->id }}/items">{{$feed->feed_name }}</a></td>
                        @if(isset($feed->category->id))
                            <td><a href="categories/{{$feed->category->id}}/items">{{$feed->category->name}}</a></td>
                        @else
                            <td>Not Available</td>
                        @endif
                        <td>{{ $feed->items_limit}}</td>
                        <td><a href="{{ $feed->url }}"> Link </a></td>
                        <td>
                            <div class="row">
                                <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-warning"
                                   href="feeds/{{ $feed->id }}/edit"><i class="fa fa-edit"></i> </a>

                                <form action="feeds/{{ $feed->id }}" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <!-- Button trigger modal -->
                                    <button type="button"
                                            class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger"
                                            data-toggle="modal"
                                            data-target="#deleteFeed{!! $feed->id !!}">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" data-backdrop="static" id="deleteFeed{!! $feed->id !!}" tabindex="-1"
                                         role="dialog"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if($feed->items->count() > 0)
                                                        @if($feed->items->count() == 1)
                                                            <h5> [{{ $feed->items->count() }}] item will also be deleted
                                                                along with
                                                                '{{ $feed->feed_name }} ' feed
                                                                source. Continue?</h5>
                                                        @else
                                                            <h5> [{{ $feed->items->count() }}] items will also be
                                                                deleted along with
                                                                '{{ $feed->feed_name }} ' feed
                                                                source. Continue?</h5>
                                                        @endif
                                                    @else
                                                        <h5> Are you sure to delete '{{ $feed->feed_name }} ' feed
                                                            source?</h5>
                                                    @endif

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success"
                                                            data-dismiss="modal">Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- / Modal -->

                                </form>

                            </div>


                        </td>

                    </tr>

                @endforeach
                </tbody>
            </table>

            @else
              <div><h4>There is no feed sources available.</h4> You can add news feed source by clicking <a href="./feeds/create">here</a></div>
            @endif
        </div>
        </div>
        {{ $feeds->links() }}
    </div>




@stop



{{--@if($feed->id->count() > 0)
    {{ '['. $feed->items->count() .'] items from '. $feed->feed_name .' will also be deleted. }}
@else
    {{ 'Are you sure to delete '. $feed->feed_name > ' feed source'}}
@endif--}}
