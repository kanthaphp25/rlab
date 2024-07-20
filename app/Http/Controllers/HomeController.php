<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductUser;
use App\Models\SalesOrder;
use DB;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Hash;
ini_set('memory_limit', '2128M');

class HomeController extends Controller
{
    public function customer_login(){
		return view('customerlogin');
	}
    public function admin_login(){
		return view('adminlogin');
	}
	
    public function login(Request $request){
		DB::enableQueryLog();
		$useractive = User::where([
		'email'=>$request->email,
		])->get();
		$query = DB::getQueryLog();
			foreach($useractive as $row)
			{
				if( $row->user_role == 1)
				{
					$request->session()->put('admin_sess_id',$row->id);
					return redirect('/productsdashboard');
				}
				else if( $row->user_role == 0){
					$request->session()->put('customer_sess_id',$row->id);
					return redirect('/');
				}
				else
				{
					return redirect('/');
				}
			}
		}
    public function products_dashboard(){
		$products = Product::all();
		return view('products',compact('products')); 
		}
    public function cart_products(Request $request){
		// echo 'product id : '.$request->productid.'<br> user id :'.$request->session()->get('customer_sess_id');exit;
		// DB::enableQueryLog();
		$Cart =new ProductUser();
		$Cart->user_id = $request->session()->get('customer_sess_id');
		$Cart->product_id = $request->productid;
		$Cart->quantity = 1;
		$Cart->save();
		// $query = DB::getQueryLog();
		// dd($query);
		return redirect('cartview'); 
		}
    public function cart_view(Request $request){
		DB::enableQueryLog();
		// $senddata  = User::find($request->session()->get('customer_sess_id'));
		$senddata  = User::find($request->session()->get('customer_sess_id'));
		$cartproducts = $senddata->products;
	
		$query = DB::getQueryLog();
		// dd($cartproducts->first()->pivot->quantity);
		return view('esite.cart',compact('cartproducts')); 
	} 
    public function quantity_update(Request $request){
		$product = Product::find($request->prodid);
		$user = User::find($request->session()->get('customer_sess_id'));
		if($product->quantity >= $request->quantity)
		{
			$user->products()->updateExistingPivot($product->id,['quantity'=>$request->quantity]);
			return response()->json($product);
		}
		else
		{
			return response()->json(['max'=>'Maximum product quantity is available only : '.$product->quantity]);
		}
	}
    public function place_order(Request $request){
		$senddata  = User::find($request->session()->get('customer_sess_id'));
		$count = ProductUser::count();
		$cartproducts = $senddata->products;
			for($i = 0; $i < $count; $i++ )
			{
				$order =new SalesOrder();
				$order->user_id = $cartproducts[$i]->pivot->user_id;
				$order->product_id = $cartproducts[$i]->pivot->product_id;
				$order->unit_price = 	$cartproducts[$i]->price;
				$order->quantity = 	$cartproducts[$i]->pivot->quantity;
				$order->total_amt = 	$cartproducts[$i]->pivot->quantity * $cartproducts[$i]->price;
				$order->save();
				$cartprod = ProductUser::where('product_id',$cartproducts[$i]->pivot->product_id);
				$cartprod->delete();
			}
		
		return redirect('/'); 
	}
	public function salesorder_list(){
		$cartprod = SalesOrder::all();
		try
		{
			return response()->json([
			'status' =>true,
			'data'=>$cartprod,
			'message' => 'user created successfully',
			],200);
		}catch(\Throwble $th){
			return response()->json([
			'status' => false,
			'message' => $th->getMessage(),
			],500);
		}
	}
	public function sales_orderlist(){
		
		  // Create a new Guzzle client instance
        $client = new Client();
		$apiUrl = "http://127.0.0.1:8000/api/salesorderlist";
        try {
            $response = $client->get($apiUrl);
			dd($response);
            $data = json_decode($response->getBody(), true);
            return view('salesorderlist', ['salesorders' => $data]);
        } catch (\Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
	}
	public function delete_prodcart($id){
		$cartprod = ProductUser::find($id);
		$cartprod->delete();
		return redirect('/cartview'); 
	}
	public function create_product(){
		return view('createproduct'); 
	}
    public function product_insert(Request $request, Product $product){
		
		DB::enableQueryLog();
        Product::create([
		'title'=>$request->title,
		'quantity'=>$request->quantity,
		'price'=>$request->price,
		]);
		$query = DB::getQueryLog();
		// dd($query);		
 					return redirect('/productsdashboard'); 

 
 
		$product->title = $request->title;
		$product->quantity = $request->quantity;
		$product->price = $request->price;
		$saved = $product->save();
		if($saved)
		{
			return redirect('/productsdashboard'); 
		}
		else
		{
			echo "product not inserted.";
		}
 
	}
}
