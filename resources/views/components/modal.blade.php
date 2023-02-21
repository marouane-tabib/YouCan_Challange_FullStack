<!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-3 float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <form method="POST" action="{{ route('product.create') }}" enctype="multipart/form-data">
        <div class="modal-body">
                @csrf
                @method('POST')
                <div class="mb-3">
                  <label for="image" class="col-form-label">Image:</label>
                  <input type="file" name="image" class="form-control" id="image">
                  @error('image')
                    <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="product-name" class="col-form-label">Product Name:</label>
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="product-name" placeholder="Add Your Product Name">
                  @error('name')
                    <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="description-text" class="col-form-label">Description:</label>
                  <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description-text"></textarea>
                  @error('description')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="category" class="col-form-label">Category:</label>
                  <select name="category_id" id="category" class="form-control @error('category') is-invalid @enderror">
                    <option value="" disabled selected>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                  @error('category_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="price" class="col-form-label">Price:</label>
                  <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Add Your Product Price">
                  @error('price')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
            </form>
      </div>
    </div>
  </div>
