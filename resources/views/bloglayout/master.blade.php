<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>
@include('bloglayout.header')

<body>






@yield('dashboard')
@stack('scripts')
@include('bloglayout.footer')
</body>
</html>
