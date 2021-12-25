@props['edit_feed', '$edit_item']
<div class="col-sm-9">
    <select id="category_id" class="form-control" name="category_id">
        @if(isset($edit_feed->category->id))
            <option selected value="{{ $edit_feed->category->id }}"> {{ $edit_feed->category->name }} </option>
            @foreach (App\Models\Category::where('id', '!=', $edit_feed->category->id)->get() as $category)
            <option value="{{ $category->id }}"> {{ $category->name }} </option>
            @endforeach
        @elseif(isset($edit_item->category->id))
            <option selected value="{{ $edit_item->category->id }}"> {{ $edit_item->category->name }} </option>
            @foreach (App\Models\Category::where('id', '!=', $edit_item->category->id)->get() as $category)
            <option value="{{ $category->id }}"> {{ $category->name }} </option>
            @endforeach
        @else
            <option value="">Select Category</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}"> {{ $category->name }} </option>
            @endforeach
        @endif
    </select>
</div>