<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    @stack('title')
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    @include('includes.head')
  </head>
  <body class="skin-blue">
    <div class="wrapper">

    @include('includes.header')
      
      
      <!-- Left side column. contains the logo and sidebar -->
    @include('includes.left-side')
      

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
      </div><!-- /.content-wrapper -->
      @include('includes.footer')
   
  </body>
</html>