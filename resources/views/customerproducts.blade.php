@extends('layout.homepage')
@section('content')
     <h3 align="center">Welcome to Ecommerce site</h3><br />
  <article>
<div class="container">
  <h2>Products List</h2>
	  <table class="table table-bordered">
		<thead>
		  <tr>
			<th>S.No</th>
			<th>Title</th>
			<th>Quantity</th>
			<th>Price</th>
		  </tr>
		</thead>
		<tbody>
		@foreach($products as $row)
		  <tr>
			<td>{{ $row->id }}</td>
			<td>{{ $row->title }}</td>
			<td>{{ $row->quantity }}</td>
			<td>{{ $row->price }}</td>
		  </tr>
		  @endforeach
		</tbody>
	  </table>
	</div>
 </article>

@endsection