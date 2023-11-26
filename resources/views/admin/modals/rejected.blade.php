<!-- Modal -->
<div class="modal fade" id="addRejectedModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Add Rejected Products</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="employeeForm" method="POST" action="{{ route('inventory.rejected.post') }}">
                @csrf
                <h6>Rejected Information</h6>
                <div class="row border p-2">
                   
                    <div class="col-sm-4 mb-3">
                        <label for="productType" class="form-label">Product Type</label>
                        <input type="text" name="product_type" class="form-control" id="productType" required>
                    </div>

                    <div class="col-sm-4 mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" name="product_name" class="form-control" id="productName">
                    </div>

                    <div class="col-sm-4 mb-3">
                        <label for="productBrand" class="form-label">Product Brand</label>
                        <input type="text" name="product_brand" class="form-control" id="productBrand" required>
                    </div>
                    
                </div>

                <div class="row border p-2 mt-2">
                    
                    <div class="col-sm-4 mb-3">
                        <label for="productStock" class="form-label">Product Quantity</label>
                        <input type="number" name="stocks" class="form-control" id="productStock" required>
                    </div>

                    <div class="col-sm-4 mb-3">
                        <label for="productPrice" class="form-label">Product Price</label>
                        <input type="number" name="product_pcs_price" class="form-control" id="productPrice" required>
                    </div>
                    
                </div>

                <button type="submit" class="btn btn-dark mt-2 float-end">Add Rejected</button>
            </form>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button> --}}
        </div>
      </div>
    </div>
  </div>