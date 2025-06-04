<nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="{{asset('admintemplate/img/avatar-6.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">Mark Stephen</h1>
            <p>Web Designer</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                  <a href="{{ url('admin/dashboard') }}"><i class="icon-home"></i>Home</a>
                </li>

                <li class="{{ request()->is('admin/categories*') ? 'active' : '' }}">
                  <a href="{{ url('admin/categories') }}"><i class="icon-grid"></i>Categories</a>
                </li>

                <li class="{{ request()->is('admin/products*') ? 'active' : '' }}">
                  <a href="{{ url('admin/products') }}"><i class="icon-cloud"></i>products</a>
                </li>
                
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Example dropdown </a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                  </ul>
                </li>
                
        {{-- </ul><span class="heading">Extras</span>
        <ul class="list-unstyled">
          <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
        </ul> --}}
      </nav>