<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>
@include('bloglayout.header')

<body>


@include('bloglayout.sidebar')



@include('bloglayout.nav')



@yield('content')

@include('bloglayout.footer')
  </body>
  </html>
