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
        <div class="col-lg-6">
            <div class="block">
                <div class="title">
                    <strong class="d-block">{{ isset($category) ? 'Edit Prodct' : 'Create New Prodct' }}</strong>
                    <span class="d-block">Manage your product products</span>
                </div>
                <div class="block-body">
                    <form class="form-horizontal" method="POST" 
                        action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if(isset($product))
                            @method('PUT')
                        @endif

                        <!-- Name Field -->
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name"
                                    value="{{ old('name', $product->name ?? '') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    required>
                                @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Categories Multi-Select -->
                        
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Categories</label>
                            <div class="col-sm-9">
                                <select name="categories[]" class="form-control" multiple>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (isset($product) && $product->categories->contains($category->id)) || collect(old('categories'))->contains($category->id) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categories')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Price</label>
                            <div class="col-sm-9">
                                <input type="number" step="0.01" name="price" class="form-control"
                                    value="{{ old('price', $product->price ?? '') }}" required>
                            </div>
                        </div>

                        <!-- SKU -->
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">SKU</label>
                            <div class="col-sm-9">
                                <input type="text" name="sku" class="form-control"
                                    value="{{ old('sku', $product->sku ?? '') }}">
                            </div>
                        </div>

                        <!-- Stock Quantity -->
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Stock Quantity</label>
                            <div class="col-sm-9">
                                <input type="number" name="stock_quantity" class="form-control"
                                    value="{{ old('stock_quantity', $product->stock_quantity ?? '') }}">
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="image" class="form-control">
                                @if(isset($product) && $product->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $product->image) }}" width="100">
                                        <label class="d-block mt-2">
                                            <input type="checkbox" name="remove_image"> Remove current image
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Status</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1"
                                    {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                                Active
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($product) ? 'Update' : 'Create' }} Product
                                </button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary ml-2">Cancel</a>
                            </div>
                        </div>
                    </form>

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