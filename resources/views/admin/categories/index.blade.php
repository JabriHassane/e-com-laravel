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
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
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
                    <div class="title"><strong>Categories List</strong></div>
                    <div class="btn-group">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary rounded">
                            <i class="icon-plus"></i> Add New Category
                        </a>
                        @include('admin.categories.uploadCategories')
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Parent Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->parent->name ?? '-' }}</td>
                                <td>
                                    <span class="badge badge-{{ $category->is_active ? 'success' : 'danger' }}">
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <!-- View Button -->
                                    <button type="button"
                                        class="btn btn-sm btn-info"
                                        data-toggle="modal"
                                        data-target="#categoryModal{{ $category->id }}"
                                        title="View">
                                        <i class="icon-light-bulb"></i>
                                    </button>

                                    <!-- Edit Button -->
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-secondary">
                                        <i class="icon-settings"></i>
                                    </a>
                                    
                                    <!-- Delete Form -->
                                    <button type="button"
                                        class="btn btn-sm btn-danger"
                                        data-toggle="modal"
                                        data-target="#deleteModal{{ $category->id }}">
                                        <i class="icon-close"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal for this category -->
                            <div class="modal fade" id="categoryModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel{{ $category->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content text-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="categoryModalLabel{{ $category->id }}">Category Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Name:</strong> {{ $category->name }}</p>
                                            <p><strong>Description:</strong> {{ $category->description ?? '-' }}</p>
                                            <p><strong>Active:</strong> {{ $category->is_active ? 'Yes' : 'No' }}</p>
                                            @if($category->image)
                                                <p><strong>Image:</strong><br>
                                                    <img src="{{ asset('storage/' . $category->image) }}" alt="Category image" class="img-fluid rounded" width="200">
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
                            <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $category->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content text-left">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $category->id }}">Confirm Deletion</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete the category <strong>{{ $category->name }}</strong>? This action cannot be undone.
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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