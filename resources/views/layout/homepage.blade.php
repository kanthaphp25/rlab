
@extends('layout.main')
@section('content')
     <h3 align="center">Welcome to Ecommerce site</h3><br />
	<div class="text-center" style="padding-bottom:50px;">	 
	 <a href="{{url('/customerlogin')}}"><button type="button" class="btn">Customer Login</button></a>
	<a href="{{url('/adminlogin')}}"><button type="button" class="btn">Admin Login</button></a>

@endsection