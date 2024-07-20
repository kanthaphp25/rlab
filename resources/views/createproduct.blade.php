@extends('admindashbord')
@section('content')
  <article>
<div class="container">
   <h3 align="center">Create Product</h3><br />

   <form method="post" action="{{ url('/productinsert') }}">
    {{ csrf_field() }}
    <div class="form-group">
     <label>Product Title</label>
     <input type="text" name="title" class="form-control" />
    </div>
    <div class="form-group">
     <label>Quantity</label>
     <input type="text" name="quantity" class="form-control" />
    </div>
    <div class="form-group">
     <label>Price</label>
     <input type="text" name="price" class="form-control" />
    </div>
    <div class="form-group text-center">
     <input type="submit" name="login" class="btn btn-primary " value="Submit" />
	 
    </div>
   </form>
</article>
@endsection()