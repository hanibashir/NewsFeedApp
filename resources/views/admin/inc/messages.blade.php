@if(count($errors) > 0)

    <div class="alert alert-warning col-sm-12">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @foreach($errors->all() as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    </div>


@endif


@if(Session::has('success'))
    <div class="myalert alert-float alert alert-success alert-dismissable" id="notification_box">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {{Session::get('success')}}
    </div>


@else
    @if(session('failed'))
        <div class="alert alert-danger centered col-sm-4">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="color: white">&times;</span>
            </button>
        </div>
    @endif
@endif
