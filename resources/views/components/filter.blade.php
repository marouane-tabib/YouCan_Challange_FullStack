<div class="card-body mt-3">
    <form action="{{ route('prduct.index') }}" method="get">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <select name="sort_by" class="form-control">
                        <option value="" selected>Sort by</option>
                        <option value="price" {{ old('sort_by' , request()->input('sort_by')) == 'price' ? 'selected' : '' }}>Price</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="order_by" class="form-control">
                        <option value="">Order by</option>
                        <option value="asc" {{ old('order_by' , request()->input('order_by')) == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ old('order_by' , request()->input('order_by')) == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="category_filter" class="form-control">
                        <option value="" selected>Filter by</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_filter' , request()->input('category_filter')) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-1">
                <button type="submit" name="filter" class="btn btn-info">Search</button>
            </div>
        </div>
    </form>
</div>
