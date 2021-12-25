@extends('adminlte::page')

@section('title', ' Categories')

@section('content_header')

@stop

@section('content')

    @include('admin.inc.messages')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <h3>Feed Sources</h3>
                <a type="button" href="categories/create" class="ml-auto mr-5 btn btn-primary btn-sm card-header-pills">
                    <h5>Add New Category</h5></a>

            </div>
        </div>
        <div class="card-body">
            @if(count($cats) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Feeds</th>
                    <th>Items</th>
                    <th>Edit</th>
                </tr>

                </thead>
                <tbody>
                @foreach($cats as $cat)
                    <tr>
                        <td><img src="{{ asset('storage/uploads/images/cats/' . $cat->logo) }}" width="75" height="75">
                        </td>
                        <td>{{$cat->name }}</td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="row">

                                <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-warning"
                                   href="categories/{{ $cat->id }}/edit"><i class="fa fa-edit"></i> </a>


                                <!-- delete -->
                                <form action="categories/{{ $cat->id }}" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <!-- Button trigger modal -->
                                    <button type="button"
                                            class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger"
                                            data-toggle="modal"
                                            data-target="#deleteItem">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" data-backdrop="static" id="deleteItem" tabindex="-1"
                                         role="dialog"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5> Are you sure you want to delete category: {{ $cat->name }}?</h5>


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
        </div>

        @else
              <div><h4>There is no categories available.</h4> You can add new category by clicking <a href="./categories/create">here</a></div>
            @endif
            </div>
        {{ $cats->links() }}
    </div>

@stop

