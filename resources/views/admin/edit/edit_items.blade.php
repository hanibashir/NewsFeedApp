@extends('adminlte::page')

@section('title', 'Edit Item')



@section('content')

    @include('admin.inc.messages')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form method="POST"
                          @if(isset($edit_item))  action="{{route('items.update',$edit_item) }}"
                          @else
                          action="{{ route('items.store') }}"
                          @endif
                          enctype="multipart/form-data"
                          accept-charset="UTF-8">
                    @csrf
                    @if(isset($edit_item))  @method('PUT') @endif

                    <!-- input title -->
                        <div class="form-group row">
                            <label for="item_title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-12">
                                <input id="item_title"
                                       value="{{isset($edit_item) ? $edit_item->title : old('item_title', '')}}"
                                       type="name" class="form-control" name="item_title" placeholder="Item Title">
                            </div>
                        </div>
                        <!-- //input title -->

                        <!-- input description -->
                        <div class="form-group row">
                            <label for="item_description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-12">
                        <textarea id="item_description"
                                  type="name" class="form-control"
                                  name="item_description" placeholder="Item Description">
                            {{isset($edit_item) ? $edit_item->description : old('item_description', '')}}
                        </textarea>
                            </div>
                        </div>
                        <!-- //input description -->

                        <!-- Item Category & Feed row-->
                        <div class="form-group row">
                            <!-- Select Item Category -->
                            <div class="col-sm-6">
                                <div class="row">
                                    <label for="category_id" class="col-sm-3 col-form-label">Category</label>
                                    @if(App\Models\Category::all()->count() > 0)
                                        <div class="col-sm-6">
                                            <select id="category_id" class="form-control" name="category_id">
                                                @if(isset($edit_item))
                                                    @if(isset($edit_item->category->id))
                                                        <option selected
                                                                value="{{ $edit_item->category->id }}"> {{ $edit_item->category->name }} </option>
                                                        @foreach (App\Models\Category::where('id', '!=', $edit_item->category->id)->get() as $category)
                                                            <option
                                                                value="{{ $category->id }}"> {{ $category->name }} </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Select Category</option>
                                                        @foreach (App\Models\Category::all() as $category)

                                                            <option
                                                                value="{{ $category->id }}"> {{ $category->name }} </option>
                                                        @endforeach
                                                    @endif
                                                @else
                                                    <option value="">Select Category</option>
                                                    @foreach (App\Models\Category::all() as $category)

                                                        <option
                                                            value="{{ $category->id }}"> {{ $category->name }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    @else
                                        <div class="col-sm-9">
                                            <h5 class="muted-link">
                                                No Categories
                                                <a href="{{ url('admin') }}/categories/create">Click Here</a>
                                                to add new
                                            </h5>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!--//Select Item Category -->

                            <!-- Select Item Feed -->
                            <div class="col-sm-6">
                                <div class="row">
                                    <label for="feed_id" class="col-sm-4 col-form-label">Feed</label>
                                    @if(App\Models\Feed::all()->count() > 0)
                                        <div class="col-sm-6">
                                            <select id="feed_id" class="form-control" name="feed_id">
                                                @if(isset($edit_item))
                                                    @if(isset($edit_item->feed->id))
                                                        <option selected
                                                                value="{{ $edit_item->feed->id }}"> {{ $edit_item->feed->feed_name }} </option>
                                                        @foreach (App\Models\Feed::where('id', '!=', $edit_item->feed->id)->get() as $feed)
                                                            <option
                                                                value="{{ $feed->id }}"> {{ $feed->feed_name }} </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Select Feed</option>
                                                        @foreach (App\Models\Feed::all() as $feed)

                                                            <option
                                                                value="{{ $feed->id }}"> {{ $feed->feed_name }} </option>
                                                        @endforeach
                                                    @endif
                                                @else
                                                    <option value="">Select Feed</option>
                                                    @foreach (App\Models\Feed::all() as $feed)

                                                        <option
                                                            value="{{ $feed->id }}"> {{ $feed->feed_name }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    @else
                                        <div class="col-sm-9">
                                            <h5 class="muted-link">
                                                No Feed Sources
                                                <a href="{{ url('admin') }}/feeds/create">Click Here</a>
                                                to add new
                                            </h5>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- //Select Item Feed -->
                        </div>
                        <!-- //Item Category & Feed row-->

                        <!-- input Item Thumbnail & preview row -->
                        <div class="form-group row">
                            <!-- input Item Thumbnail -->
                            <div class="col-sm-6">
                                <div class="row">
                                    <label for="item_thumbnail" class="col-sm-3 col-form-label">Thumbnail</label>
                                    <div class="col-sm-7">
                                        <input id="item_thumbnail"
                                               type="file" class="form-control" name="item_thumbnail"
                                               placeholder="Item Thumbnail">
                                    </div>
                                </div>
                            </div>
                            <!-- //input Item Thumbnail -->

                            <!-- preview Item Thumbnail -->
                            @if(isset($edit_item))
                            <div class="col-sm-6">
                                <div class="row">
                                    <label for="item_thumbnail" class="col-sm-4 col-form-label">Current Thumbnail</label>
                                    <div class="col-sm-8">
                                        <img class="img-fluid img-thumbnail"
                                             src="{{ asset('storage/uploads/images/items/' . $edit_item->thumbnail) }}"
                                             width="150"
                                             height="150">
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!-- //preview Item Thumbnail -->
                        </div>
                        <!-- input Item Thumbnail & preview row -->



                        <!-- Published -->
                            <div class="form-group row">
                                <label for="published" class="col-sm-2 col-form-label">Published</label>

                                <div class="checkbox checkbox-success">
                                    @if(isset($edit_item) && $edit_item->published == 1)
                                        <input type="checkbox" name="published" value="1" checked>
                                    @elseif(isset($edit_item) && $edit_item->published == 0)
                                        <input type="checkbox" name="published" value="1">
                                    @else
                                        <input type="checkbox" name="published" value="1" checked>
                                    @endif
                                </div>
                            </div>

                        <!-- //Published -->

                        <!-- input item Url -->
                        <div class="form-group row">
                            <label for="item_url" class="col-sm-2 col-form-label">Link</label>
                            <div class="col-sm-12">
                                <input id="item_url"
                                       value="{{isset($edit_item) ? $edit_item->url : old('item_url', '')}}"
                                       type="name" class="form-control" name="item_url" placeholder="Item Url">
                            </div>
                        </div>
                        <!-- //input item Url -->


                        <!-- Submit Button -->
                        <div>
                            <div class="card-footer text-center">
                                <button type="add" class="btn btn-primary form-group">@if(isset($edit_item))
                                        Update @else Add New Item @endif </button>
                            </div>
                        </div>
                        <!-- //Submit Button -->

                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.main-card -->

        <!-- ckeditor -->
        <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('item_description');
        </script>
        <!-- //ckeditor -->

@stop
