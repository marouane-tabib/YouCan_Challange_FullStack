<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
            <form method="POST" action="{{ route('product.create') }}">
        <div class="modal-body">
                @csrf
                @method('POST')
                <div class="mb-3">
                  <label for="product-name" class="col-form-label">Product Name:</label>
                  <input type="text" name="name" class="form-control" id="product-name" placeholder="Add Your Product Name">
                </div>
                <div class="mb-3">
                  <label for="description-text" class="col-form-label">Description:</label>
                  <textarea name="description" class="form-control" id="description-text"></textarea>
                </div>
                <div class="mb-3">
                  <label for="price" class="col-form-label">Price:</label>
                  <input type="text" name="price" class="form-control" id="price" placeholder="Add Your Product Price">
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
