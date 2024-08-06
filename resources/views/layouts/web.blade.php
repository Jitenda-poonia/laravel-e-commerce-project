<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    @yield('title')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

 @include('includes.web-head')
</head>

<body>
 @include('includes.web-header')
 @include('includes.web-nav')
@yield('content')
 @include('includes.web-footer')
 @stack('custom-scripts')

</body>

</html>
