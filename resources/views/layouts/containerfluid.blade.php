@extends('layouts.app')
@section('content')
<div class="content">
  <div class="container-fluid">
    @include('flash::message')
    @yield('containerfluid')
  </div>
</div>
@endsection
