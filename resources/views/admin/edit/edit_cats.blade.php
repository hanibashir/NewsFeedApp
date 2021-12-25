@extends('adminlte::page')

@section('title', 'Edit Categories')



@section('content')

    @include('admin.inc.messages')
    <div class="row">
        <div class="col-md-8">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form method="POST"
                          @if(isset($edit_cat))  action="{{route('categories.update',$edit_cat) }}"
                          @else
                          action="{{ route('categories.store') }}"
                          @endif
                          enctype="multipart/form-data"
                          accept-charset="UTF-8">
                    @csrf
                    @if(isset($edit_cat))  @method('PUT') @endif

                    <!-- input cat name -->
                        <div class="form-group row">
                            <label for="cat_name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input id="cat_name"
                                       value="{{isset($edit_cat) ? $edit_cat->name : old('cat_name', '')}}"
                                       type="name" class="form-control" name="cat_name" placeholder="Category Name">
                            </div>
                        </div>
                        <!-- //input cat name -->


                        <!-- input Feed Logo -->
                        <div class="form-group row">
                            <label for="cat_logo" class="col-sm-3 col-form-label">Logo</label>
                            <div class="col-sm-6">
                                <input id="cat_logo"
                                       type="file" class="position-relative form-group form-control-file"
                                       name="cat_logo"
                                       placeholder="Category Logo">
                            </div>

                            @if(isset($edit_cat))
                            <div class="col-sm-3">
                                <img class="img-fluid img-thumbnail"
                                     src="{{asset('storage/uploads/images/cats/' . $edit_cat->logo)}}"
                                     width="150"
                                     height="150">
                            </div>
                            @endif

                        </div>
                        <!-- input Feed Logo -->

                        <!-- Submit Button -->
                        <div class=" text-center">
                            <div class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn">
                                <button type="add" class="btn btn-primary form-group">@if(isset($edit_cat))
                                        Update {{ $edit_cat->name }} @else Add New Category @endif </button>
                            </div>
                        </div>
                        <!-- //Submit Button -->

                    </form>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /card -->

    </div>
@stop
