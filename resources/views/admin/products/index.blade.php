<!DOCTYPE html>
<html>
  <head> 
    @include('admin.head')
    <style>
        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
    </style>
  </head>
  <body>
    <!-- Header -->
    @include('admin.header')
    <!-- Header end -->

    <div class="d-flex align-items-stretch">

      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            
        <!-- body content  -->    
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Products</li>
          </ul>
        </div>
        
        {{-- error in the csv files --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>There were some errors with your submission:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-lg-12">
            <div class="block">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="title"><strong>Products List</strong></div>
                    <div class="btn-group">
                        <a href="{{ route('products.create') }}" class="btn btn-primary rounded">
                            <i class="icon-plus"></i> Add New Product
                        </a>
                        @include('admin.products.uploadProducts')
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Categories</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach($products as $product)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->slug }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->stock_quantity }}</td>
                                <td>
                                    <span class="badge badge-{{ $product->is_active ? 'success' : 'danger' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    @foreach ($product->categories as $cat)
                                        <span class="badge badge-info">{{ $cat->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <!-- View Button -->
                                    <button type="button"
                                        class="btn btn-sm btn-info"
                                        data-toggle="modal"
                                        data-target="#categoryModal{{ $product->id }}"
                                        title="View">
                                        <i class="icon-light-bulb"></i>
                                    </button>

                                    <!-- Edit Button -->
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-secondary">
                                        <i class="icon-settings"></i>
                                    </a>
                                    
                                    <!-- Delete Form -->
                                    <button type="button"
                                        class="btn btn-sm btn-danger"
                                        data-toggle="modal"
                                        data-target="#deleteModal{{ $product->id }}">
                                        <i class="icon-close"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal for this category -->
                            <div class="modal fade" id="categoryModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content text-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="categoryModalLabel{{ $product->id }}">Category Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Name:</strong> {{ $product->name }}</p>
                                            <p><strong>Description:</strong> {{ $product->description ?? '-' }}</p>
                                            <p><strong>Active:</strong> {{ $product->is_active ? 'Yes' : 'No' }}</p>
                                            @if($product->image)
                                                <p><strong>Image:</strong><br>
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Category image" class="img-fluid rounded" width="200">
                                                </p>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content text-left">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $product->id }}">Confirm Deletion</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete the category <strong>{{ $product->name }}</strong>? This action cannot be undone.
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                
            </div>
        </div>
        <!-- body content end  -->

        <!-- footer -->
            @include('admin.footer')
        <!-- footer end -->
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.scriptTag')
  </body>
</html>