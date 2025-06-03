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
    <script src="{{asset('admintemplate/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admintemplate/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admintemplate/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admintemplate/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admintemplate/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admintemplate/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admintemplate/js/charts-home.js')}}"></script>
    <script src="{{asset('admintemplate/js/front.js')}}"></script>
  </body>
</html>