@extends('adminlte::page')

@section('title', 'Edit Feed')



@section('content')

@include('admin.inc.messages')
<div class="row">
    <div class="col-md-8">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <form method="POST" @if(isset($edit_feed)) action="{{route('feeds.update',$edit_feed) }}" @else action="{{ route('feeds.store') }}" @endif enctype="multipart/form-data" accept-charset="UTF-8">
                    @csrf
                    @if(isset($edit_feed)) @method('PUT') @endif

                    <!-- input source name -->
                    <div class="form-group row">
                        <label for="feed_name" class="col-sm-3 col-form-label">Source Name</label>
                        <div class="col-sm-9">
                            <input id="feed_name" value="{{isset($edit_feed) ? $edit_feed->feed_name : old('feed_name', '')}}" type="name" class="form-control" name="feed_name" placeholder="Source Name">
                        </div>
                    </div>
                    <!-- //input source name -->

                    <!-- input source Url -->
                    <div class="form-group row">
                        <label for="feed_url" class="col-sm-3 col-form-label">Source Url</label>
                        <div class="col-sm-9">
                            <input id="feed_url" value="{{isset($edit_feed) ? $edit_feed->url : old('feed_url', '')}}" type="name" class="form-control" name="feed_url" placeholder="Source Url">
                        </div>

                    </div>
                    <!-- //input source Url -->

                    <!-- input Items Limit -->
                    <div class="form-group row">
                        <label for="items_limit" class="col-sm-3 col-form-label">Items Limit</label>
                        <div class="col-sm-9">
                            <select name="items_limit" id="items_limit" class="form-control">

                                @if(isset($edit_feed))
                                <option value="{{$edit_feed->items_limit}}">{{$edit_feed->items_limit}}</option>
                                @for($i=1; $i<31;$i++) <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                    @else
                                    @for($i=1; $i<31;$i++) <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                        @endif
                            </select>

                        </div>
                    </div>
                    <!-- //input source Items Limit -->

                    <!-- Select feed source Category -->
                    <div class="form-group row">
                        <label for="category_id" class="col-sm-3 col-form-label">Feed Category</label>
                        @if(App\Models\Category::all()->count() > 0)
                        <div class="col-sm-9">
                            <select id="category_id" class="form-control" name="category_id">
                                @if(isset($edit_feed))
                                @if(isset($edit_feed->category->id))
                                <option selected value="{{ $edit_feed->category->id }}"> {{ $edit_feed->category->name }} </option>
                                @foreach (App\Models\Category::where('id', '!=', $edit_feed->category->id)->get() as $category)
                                <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                                @else
                                <option value="">Select Category</option>
                                @foreach (App\Models\Category::all() as $category)

                                <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                                @endif
                                @else
                                <option value="">Select Category</option>
                                @foreach (App\Models\Category::all() as $category)

                                <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        @else
                        <div class="col-sm-9">
                            <h5 class="muted-link">
                                No Categories
                                <a href="{{ url('admin') }}/categories/create">Click Here</a>
                                to add Categories
                            </h5>
                        </div>

                        @endif

                    </div>
                    <!-- //Select source Category -->

                    <!-- input source Logo -->
                    <div class="form-group row">
                        <label for="feed_logo" class="col-sm-3 col-form-label">Source Logo</label>
                        <div class="col-sm-6">
                            <input id="feed_logo" type="file" class="position-relative form-group form-control-file" name="feed_logo" placeholder="Source Logo">
                        </div>

                        @if(isset($edit_feed))
                        <div class="col-sm-3">
                            <img class="img-fluid img-thumbnail" src="{{ asset('storage/uploads/images/feeds/' . $edit_feed->logo) }}" width="150" height="150">
                        </div>
                        @endif
                    </div>
                    <!-- input source Logo -->

                    <!-- Cron Job -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Cron Job:</label>

                                <div class="col-sm-6 checkbox checkbox-success">
                                    @if(isset($edit_feed) && $edit_feed->cron_update == 1)
                                    <input type="checkbox" name="cron_job" value="1" checked>
                                    @elseif(isset($edit_feed) && $edit_feed->cron_update == 0)
                                    <input type="checkbox" name="cron_job" value="1">
                                    @else
                                    <input type="checkbox" name="cron_job" value="1" checked>
                                    @endif
                                </div>

                                <small class="form-text text-muted"> Automatically grab news from this
                                    source</small>
                            </div>
                        </div>
                        <!-- //Cron Job -->

                        <!-- Select Update Rate -->
                        <div class="col-sm-6">

                            <div class="form-group row">
                                <label for="update_rate" class="col-sm-5 col-form-label">Run Every:</label>
                                <div class="col-sm-7">
                                    <select id="update_rate" name="update_rate" class="position-relative form-group form-control">

                                        @for($m = 15;$m < 61;$m=$m + 15) 
                                            <option value="{{ $m * 60 }}">{{ $m; }} Minutes</option>
                                        @endfor
                                        @for($h = 2; $h < 25; $h++) 
                                            <option value="{{ $h * 3600 }}">{{ $h; }} Hours</option>
                                        @endfor
                                        @for($d = 2; $d < 6; $d++) 
                                            <option value="{{ $d * 86400 }}">{{ $d; }} Days</option>
                                        @endfor
                                            <option value="0"> Reset</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- //Select Update Rate -->
                    </div>


                    <!-- Submit Button -->
                    <div class=" text-center">
                        <div class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn">
                            <button type="add" class="btn btn-primary form-group">@if(isset($edit_feed))
                                Update {{ $edit_feed->feed_name }} @else Add New Feed Source @endif </button>
                        </div>
                    </div>
                    <!-- //Submit Button -->

                </form>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /card -->

    <!-- side-bar -->
    <div class="col-md-4">
        <div class="main-card mb-3 card">
            <div class="card-body">
            </div>
        </div>
    </div>
    <!-- /side-bar -->
</div>
<!-- /row -->
@stop