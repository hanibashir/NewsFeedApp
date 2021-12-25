@extends('adminlte::page')

@section('title', ' Items')

@section('content_header')

@stop

@section('content')

    @include('admin.inc.messages')

    <div class="card">

        <div class="card-header">
            <div class="row">
                <h3>News Items</h3>
                <a type="button" href="items/create" class="ml-auto mr-5 btn btn-primary btn-sm card-header-pills">
                    <h5>Add New Item</h5></a>

            </div>
        </div>

        <div class="card-body">
            @if(count($items) > 0)
            <table class="table table-hover table-responsive col-sm-12">
                <thead>
                <tr>
                    <th style="width: 7%">Thumbnail</th>
                    <th style="width: 35%">Title</th>
                    <th style="width: 7%">Source</th>
                    <th style="width: 7%">Category</th>
                    <th style="width: 7%">Link</th>
                    <th style="width: 7%">Edit</th>
                </tr>
                </thead>



                <tbody>
                @foreach($items as $item)
                    <tr>
                        @if(!$item->thumbnail == '')
                            <td><img src="{{ asset('storage/uploads/images/items/' . $item->thumbnail) }}" width="75"
                                     height="75">
                            </td>
                        @else
                            @if(isset($item->feed->logo))
                                <td><img src="{{ asset('storage/uploads/images/feeds/' . $item->feed->logo) }}" width="75"
                                         height="75">
                                </td>
                            @else
                                <td><img src="}" width="75"
                                         height="75">
                                </td>
                            @endif
                        @endif
                        <td><a href="{{ url('/') }}/items/{{$item->id}}"
                               target="_blank">{{html_entity_decode(strip_tags($item->title)) }}</a></td>
                        @if(isset($item->feed->id))
                            <td><a href="feeds/{{$item->feed->id}}/items">{{$item->feed->feed_name}}</a></td>
                        @else
                            <td>{{Auth::user()->name }}</td>
                        @endif
                        @if(isset($item->category->id))
                            <td><a href="categories/{{$item->category->id}}/items">{{$item->category->name}}</a></td>
                        @else
                            <td>Not Available</td>
                        @endif
                        <td><a href="{{$item->url }}" target="_blank">Link</a></td>

                        <td>
                            <div class="row">
                                <!-- edit -->
                                <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-warning"
                                   href="items/{{ $item->id }}/edit"><i class="fa fa-edit"></i> </a>
                                <!-- / edit -->

                                <!-- delete -->
                                <form action="items/{{ $item->id }}" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <!-- Button trigger modal -->
                                    <button type="button"
                                            class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger"
                                            data-toggle="modal"
                                            data-target="#deleteItem{!! $item->id !!}">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" data-backdrop="static" id="deleteItem{!! $item->id !!}" tabindex="-1"
                                         role="dialog"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete Item</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5> Are you sure you want to delete this item?</h5>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success"
                                                            data-dismiss="modal">Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form><!-- / delete -->

                            </div>

                        </td>

                    </tr>

                @endforeach
                </tbody>


            </table>
            @else
              <div><h4>There is no posts available.</h4> You can add new post by clicking <a href="./items/create">here</a> or add news feed source by clicking <a href="./feeds/create">here</a></div>
            @endif
        </div>

        {{ $items->links() }}

    </div>
@stop

