<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SearchHistory;
use App\Models\UserFavourite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProductReview;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Mail\SendMailDemo;
use Mail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $models = Category::get();
        $recommended_and_newArrival_products = Product::where('recommended', '=', 1)
        ->orwhere('new_arrival', '=', 1)->get();
        $retrieve_history = SearchHistory::where('user_id','=',Auth::id())
        ->orderByDesc('created_at')->limit(9)->get();
      //  dd($retrieve_history);
   
        return view('home',compact('models','recommended_and_newArrival_products','retrieve_history'));
    }

    public function specific_model($id){
        $products_of_model = Product::where('category_id','=',$id)->get();
        $sliders = DB::select("SELECT product_images.path , products.id , products.name , products.description FROM product_images INNER JOIN 
        products WHERE  product_images.product_id = products.id AND products.category_id = $id
        AND products.recommended = 1");
        //dd($sliders);
        $products_of_model_ram = Product::where('category_id','=',$id)->orderBy('ram','asc')->get();
        $products_of_model_storage = Product::where('category_id','=',$id)->orderBy('storage','asc')->get();

        $unique_ram = $products_of_model_ram->unique('ram');
        $unique_storage = $products_of_model_storage->unique('storage');
        $unique_color = $products_of_model->unique('color');
        $max_price = $products_of_model->max('price');
        $min_price = $products_of_model->min('price');
        //dd($unique_model_id);
        //dd($unique_ram);
        $retrieve_history = SearchHistory::where('user_id','=',Auth::id())
        ->orderByDesc('created_at')->limit(9)->get();

        return view('specific_model' , compact('retrieve_history','products_of_model','sliders','unique_ram','unique_storage','unique_color', 'id' ,'min_price','max_price'));
    }

    public function more_details($id){
        $product = Product::find($id);
        $reviews = UserProductReview::where('product_id','=',$id)
        ->orderBy('created_at','DESC')->get();
        //dd($product->user_reviews);
        $retrieve_history = SearchHistory::where('user_id','=',Auth::id())
        ->orderByDesc('created_at')->limit(9)->get();

        return view('more_details',compact('product','reviews','retrieve_history'));
    }

    public function add_review(Request $request , $id){
        $user_id = Auth::id();
        $review = new UserProductReview;
        $review->user_id = $user_id;
        $review->product_id= $id;
        $review->content = $request->content;
        $review->save();
        return response()->json(['message'=>'Your Review Added Successfully']);

    }

    public function filter_product(Request $request , $id){
        // dd($request);
       // dd($id);
        $products = Product::where('category_id','=',$id);
        if (isset($request->min_price)) {
            $products = $products->where('price','>=',$request->min_price);
        }
        if (isset($request->max_price)) {
            $products = $products->where('price','<=',$request->max_price);
        }
        if(isset($request->ram)){
            $products = $products->whereIn('ram',$request->ram);
        }
        if(isset($request->storage)){
            $products = $products->whereIn('storage',$request->storage);
        }
        if(isset($request->color)){
            $products = $products->whereIn('color',$request->color);
        }

        $products = $products->get();
        $retrieve_history = SearchHistory::where('user_id','=',Auth::id())
        ->orderByDesc('created_at')->limit(9)->get();


        return view('filtered_product',compact('products','retrieve_history'));


        // dd($product);



 
    }


    public function index_fav(Request $request){
       
       $user_id = Auth::id();
       $item = UserFavourite::where('product_id','=',$request->product_id)->where('user_id','=',Auth::id())->first();
       if ($item) {
        $item->delete();
        return response()->json(['message'=>'removed']);
       }else {
        $fav = new UserFavourite;
        $fav->user_id = $user_id;
        $fav->product_id= $request->product_id;
        $fav->save();
        return response()->json(['message'=>'Added']);

       }
       
    }

    public function index_del_fav(Request $request){
        $item = UserFavourite::where('product_id','=',$request->product_id)->where('user_id','=',Auth::id())->first();
        $item->delete();
    }

    public function fav_product(){
        $favourites = UserFavourite::where('user_id','=',Auth::id())->get();
        $retrieve_history = SearchHistory::where('user_id','=',Auth::id())
        ->orderByDesc('created_at')->limit(9)->get();

        return view('favourite',compact('favourites','retrieve_history'));
    }




    public function cart(){
        $carts = Cart::where('user_id','=',Auth::id())->get();
        $counter = 0;
        foreach ($carts as $cart) {
            $counter += $cart->quantity;
        }
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;           
        }

        $retrieve_history = SearchHistory::where('user_id','=',Auth::id())
        ->orderByDesc('created_at')->limit(9)->get();

        return view('cart' , compact('carts','counter','total','retrieve_history'));
    }



    public function add_cart(Request $request){
        $existed_cart = Cart::where('user_id','=',Auth::id())->get();
        if ($existed_cart->contains('product_id',$request->product_id)) {
            return response()->json(['alreadyAdded'=>'Already Added']);
        }else {
            $cart = new Cart;
            $cart->product_id = $request->product_id;
            $cart->user_id = Auth::id();
            $cart->save();
            return response()->json(['message'=>'Added Successfully To Your Cart']);
            }
        
    }


    public function del_cart(Request $request){
        $cart_item = Cart::where('user_id','=',Auth::id())->where('product_id','=',$request->product_id)->first();
        $cart_item->delete();
        $carts = Cart::where('user_id','=',Auth::id())->get();
        $counter = 0;
        foreach ($carts as $cart) {
            $counter += $cart->quantity;
        }
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;            
        }

      $retrieve_history = SearchHistory::where('user_id','=',Auth::id())
        ->orderByDesc('created_at')->limit(9)->get();

        return view('updated_cart',compact('carts','counter','total','retrieve_history'));
    }


    public function totalprice_cart(Request $request){
       $carts = Cart::where('user_id','=',Auth::id())->get();
       $check_stock = Cart::where('user_id','=',Auth::id())->where('product_id','=',$request->id)->first();
       $total_price = 0;
       
        if ($request->quantity <= 0) {
            return response()->json(['wrongQuantity'=>'Invalid Quantity']);
        }elseif ($request->quantity > $check_stock->product->quantity) {
            return response()->json(['checkStock'=>'this Quantity is Out of Stock']);
        }
        else {
            $increamented_item = Cart::where('user_id','=',Auth::id())->where('product_id','=',$request->id)->first();
            $increamented_item->quantity = $request->quantity;
            $increamented_item->save();
            $counter = 0;
            foreach ($carts as $cart) {
                $counter += $cart->quantity;
            }
            $updated_price = $increamented_item->product->price * $request->quantity;
            foreach ($carts as $cart) {
                if ($cart->product->id == $request->id) {
                    continue ;
                }
                $updated_price = $updated_price +  ( $cart->product->price * $cart->quantity );
            }
            $total_price = $updated_price;
            return response()->json(['total_price'=>$total_price , 'counter'=>$counter]);
        }
       

    }




    public function search(Request $request , $value = null){
        $search_value = $value ? : $request->search ;
        $models = Category::get();
        $search = Product::where('name','LIKE','%'.$search_value.'%')->get();
        $history = new SearchHistory;
        $history->user_id = Auth::id();
        $history->content = $search_value;
        $history->save();
        $retrieve_history = SearchHistory::where('user_id','=',Auth::id())
        ->orderByDesc('created_at')->limit(9)->get();
        
       
        return view('search' , compact('models','retrieve_history','search' ,'search_value'));
    }


    public function history(){
        $models = Category::get();
        $retrieve_history = SearchHistory::where('user_id','=',Auth::id())
        ->orderByDesc('created_at')->get();

        return view('history' , compact('models','retrieve_history'));
    }

    public function history_item_del($id){
        $item = SearchHistory::find($id);
        $item->delete();
    }

    public function history_del_all(){
        $his = SearchHistory::where('user_id','=',Auth::id())->get();
        $his->each->delete();
    }


    public function checkout($total , $quantity){
        $models = Category::get();
        $retrieve_history = SearchHistory::where('user_id','=',Auth::id())
        ->orderByDesc('created_at')->get();
        $cities = Shipping::get();
        return view('checkout',compact('total','quantity','models','retrieve_history','cities'));
    }


    public function shipping(Request $request , $total , $quantity){
        $shipping = $request->shipping_price;
        $total_price = $shipping + $total;


        return response()->json(['shipping'=>$shipping , 'total_price'=>$total_price]);

    }

    public function order_details(Request $request){
        $username = Auth::user()->name;
        $city = explode('_',$request->city);
        $city = $city[1];
        $city_shipping = explode('_',$request->city);
        $city_shipping = $city_shipping[0];

        $order = new Order;
        $order->user_id = Auth::id();
        $order->address = $request->address;
        $order->phone_number = $request->phone;
        $order->city = $city;
        $order->total_price = $request->order_price + $city_shipping;
        $order->quantity = $request->quantity;

        $order->save();
         
        $cart_items = Cart::where('user_id','=',Auth::id())->get();
        
        foreach ($cart_items as $cart_item) {
             $order_details = new OrderDetails;
             $order_details->order_id = $order->id;
             $order_details->cart_id = $cart_item->id;
            $order_details->save();
        }

        $cart_items->each->delete();



        $data = [
            'username' => $username,
            'order_id' => $order->id,
            'total_price' => $order->total_price,
            'quantity' => $order->quantity,
            'city' => $order->city,
            'address' => $order->address,
            'phone' =>$order->phone_number,
        ];

        Mail::to(Auth::user()->email)->send(new SendMailDemo($data));  //we will receive $data in constructor in sendmaildemo

        return redirect()->route('home')->with('order_message', 'Thank You , We send You invoice in your email.');

       
       
       
    }
 

}
