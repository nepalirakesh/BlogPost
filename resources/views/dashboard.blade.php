@extends('bloglayout.master')
@section('dashboard')
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home')}} "class="nav-link">Home</a>
      </li>
      </ul>
      </nav>
@include('bloglayout.sidebar')
@yield('content')
@endsection
