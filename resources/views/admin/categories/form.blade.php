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
            <li class="breadcrumb-item active">Categories</li>
          </ul>
        </div>
        <div class="col-lg-6">
            <div class="block">
                <div class="title">
                    <strong class="d-block">{{ isset($category) ? 'Edit Category' : 'Create New Category' }}</strong>
                    <span class="d-block">Manage your product categories</span>
                </div>
                <div class="block-body">
                    <form class="form-horizontal" method="POST" 
                        action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @endif

                        <!-- Name Field -->
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" 
                                    value="{{ old('name', $category->name ?? '') }}" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    placeholder="Category Name" required>
                                @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Parent Category Select -->
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Parent Category</label>
                            <div class="col-sm-9">
                                <select name="parent_id" class="form-control">
                                    <option value="">-- No Parent --</option>
                                    @foreach($categories as $cat)
                                        @if(!isset($category) || $cat->id != $category->id)
                                            <option value="{{ $cat->id }}" 
                                                {{ (old('parent_id', $category->parent_id ?? '') == $cat->id) ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control" 
                                        placeholder="Category Description">{{ old('description', $category->description ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Image</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">@</span></div>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                                @if(isset($category) && $category->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $category->image) }}" width="100">
                                        <label class="d-block mt-2">
                                            <input type="checkbox" name="remove_image"> Remove current image
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Status Checkbox -->
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Status</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="is_active" value="0">

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_active" value="1"
                                            {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}>
                                        Active
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group row">       
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($category) ? 'Update' : 'Create' }} Category
                                </button>
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary ml-2">
                                    Cancel
                                </a>
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