<!DOCTYPE html>
<html>
  <head> 
    @include('admin.head')
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
            @include('admin.body')
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