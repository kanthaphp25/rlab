<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Fruitables - Vegetable Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="" name="keywords">
        <meta content="" name="description">

@include('esite.esiteassets')
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


@include('esite.headnavbar')

        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Cart</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Cart</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Products Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
						@foreach($cartproducts as $row)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
									{{ $row->title }}
                                    </div>
                                </th>
                                <td>
                                    <p id="price_id{{ $row->id }}"class="mb-0 mt-4">{{ $row->price }}</p>
                                </td>
                                <td>
										<input type="text" style="display:none;" id="maxqt{{ $row->id }}" value="{{ $row->quantity }}">
                                    <div class="input-group  mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button onclick="update_quantity({{ $row->id }},'btnminus')" class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" id="quantity_id{{ $row->id }}" class="form-control form-control-sm text-center border-0" value="{{ $row->pivot->quantity }}">
                                        <div class="input-group-btn">
                                            <button onclick="update_quantity({{ $row->id }},'btnplus')" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 price" id="total_id{{$row->id}}">{{ $row->price * $row->pivot->quantity}}</p>
                                </td>
                                <td>
                                    <a href="{{ url('/deleteprodcart/'.$row->pivot->id) }}" class="btn btn-md rounded-circle bg-light border mt-4" >
                                        <i class="fa fa-times text-danger"></i>
                                    </a>
                                </td>
                            
                            </tr>
						@endforeach	
                        </tbody>
                    </table>
                </div>
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
							<form method="post" action="{{ url('/placeorder') }}">
							{{ csrf_field() }}
								<div class="p-4">
									<h2 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h2>
									<div class="d-flex justify-content-between mb-4">
										<h5 class="mb-0 me-4">Total Amt payable:</h5>
										<p class="mb-0" id="subtotal_id">$96.00 Rs</p>
									</div>
								</div>
								<button type="submit" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">Place Order</button>
							</form>
						</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart Page End -->
@include('esite.footer')
    </body>

</html>
<script>
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	function update_quantity(id,quantity_action){
		var maxqt = $("#maxqt"+id).val();
		let quantity = $("#quantity_id"+id).val();
		var price = $("#price_id"+id).text();
		var amt;
		if(Number(maxqt) <= Number(quantity))
		{
			if(quantity_action == 'btnminus')
			{
				amt = quant * price;
				$("#total_id"+id).text(amt);
				$("#quantity_id"+id).val(quant);
			}
			else{
				alert("Maximum product quantity is available only : "+maxqt);
				return;
			}
		}
				if(quantity_action == 'btnminus')
				{
					var quant = --quantity;
					$("#quantity_id"+id).val(quant);
					 amt = quant * price;
					$("#total_id"+id).text(amt);
				}
				else if(quantity_action == 'btnplus')
				{
					var quant = ++quantity;
					$("#quantity_id"+id).val(quant);
					amt = quant * price;
					$("#total_id"+id).text(amt);
				}
				subtotal()
				$.ajax({
					url: "{{ url('/qtajaxrequest') }}",
					type: "POST",
					dataType: 'html',
					data: {"quantity":quant,"prodid":id},
                    success: function (data) { 
							let parsedata =$.parseJSON(data);
							if (typeof parsedata.max !== 'undefined') {
								alert(parsedata.max);
							 }
                    },
					error: function(err) {
						console.log(err);
					}
                }); 
	}
function subtotal()
{	
	const str=[];
	$('.price').each(function(e){
		 str.push(Number($(this).text()));
	})
	const sum = str.reduce(add, 0); // with initial value to avoid when the array is empty
	function add(accumulator, a) {
	  return accumulator + a;
	}
	$("#subtotal_id").text(sum)
}
subtotal()
$(document).ready(function(){
	
	
});
</script>