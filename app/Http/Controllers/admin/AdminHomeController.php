<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Shipping;
use App\Models\ProductImage;
use App\Models\UserProductReview;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use DateTime;
use DatePeriod;
use DateInterval;



class AdminHomeController extends Controller
{
    //


    public function index(){
        $categories = Category::all();        
        $customers = User::all();
        $pending_orders = Order::where('status','=','pending')->get();
        $delivering_orders = Order::where('status','=','in_delivery')->get();
        $deliverd_orders = Order::where('status','=','deliverd')->get();
        $begin_of_month = new DateTime(now()->startOfMonth()->format('Y-m-d'));
        $tomorrow = new DateTime(now()->tomorrow()->format('Y-m-d'));   
        $interval = DateInterval::createFromDateString('1 day');
        
        $period_monthly = new DatePeriod($begin_of_month, $interval, $tomorrow);
        $monthly_earning = 0;
    
        foreach ($period_monthly as $date) {  
           $day_orders = Order::whereDate('created_at','=',$date->format('Y-m-d'))->where('status','=','deliverd')->get();
           if (count($day_orders) > 0) {
            
            foreach ($day_orders as $day_orders) {
                $monthly_earning = $monthly_earning + $day_orders->total_price;
                
               }
           }

           
           
        }

        return view('admin.home' , compact('monthly_earning','categories','pending_orders','delivering_orders','deliverd_orders','customers'));
    }


    //////////////////////////// Start User//////////////////////////////////////////

    public function get_users(){
        $categories = Category::all();
        $users = User::simplePaginate(10);
        return view('admin.get_user', compact('users','categories'));
    }

    public function add_user(Request $request){  //this req came from ajax req that refer to url that refer to this fun

        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        //$user->phone = $request->phone;
        $user->save();

    }

    public function edit_user(Request $request , $id){
        $user_data = User::find($id);

        $user_data->name = $request ->input('name');
        $user_data->email = $request ->input('email');
        //$user_data->phone = $request ->input('phone');

        $user_data->save();



    }

   


    public function remove_user($id){
        $user = User::findOrFail($id);
        $user->delete();

    }

    ///////////////////////////////Start Categories//////////////////////////////////////

    public function get_category(){
        $categories = Category::simplePaginate(10);
        //dd($categories);
        return view('admin.categories' , compact('categories'));
    }



    public function edit_category($id){
        $categories = Category::all();
        $specific_category = Category::findOrFail($id);
        return view('admin.edit_category' , compact('categories','specific_category'));

    }
    public function delete_category_image($id){
        //dd($id);
        $image = Category::findOrFail($id);
        $image->update(['image_path'=>null]);
        return redirect()->back();
    }

    public function delete_category($id){
        $category = Category::findOrFail($id);
        $category->delete();

    }


    
    public function upload_category(Request $request , $id)
    {
        //dd($request);
        $categories = Category::all();
       // dd($categories);

     $category = Category::find($id);
  

  $file_name = $category->image_path;
    if($request->file('image')) {
     //  dd("hi");
        $path = 'files/';
        $file = $request->file('image');
        $file_name = time().'_'.$file->getClientOriginalName();
        $upload = $file->storeAs($path , $file_name , 'public');      

      }  

            $category->name = $request->name;
            $category->image_path = $file_name;
            $category->parent_id = $request->parent;
            $category->save();

      return redirect()->route('admin.categories');
}



    public function add_new_category(){
        $categories = Category::all();
        return view('admin.add_category',compact('categories'));

    }

    public function add_category(Request $request){
        $category = new Category();
         //dd($request->file('image'));
         $file_name = null;
        if($request->hasFile('image')){
            $path = 'files/';
            $file = $request->file('image');
            $file_name = time().'_'.$file->getClientOriginalName();
            $upload = $file->storeAs($path , $file_name , 'public');
        }
       

    
            $category->name = $request->name;
            $category->image_path = $file_name;
            $category->parent_id = $request->category;
            $category->save();
            return redirect()->route('admin.categories');

       
       

    }



    ////////////////////Start Products///////////////////////////////

    public function get_product($id){
        //dd($id);
       
        $categories = Category::all();
        //dd($categories);
       
        $products = Product::where("category_id" , "=" , $id)->simplePaginate(10);

        return view('admin.products' , compact('products','categories'));
     
       // dd($products);
    //    foreach ($products as $product) {
    //      dd($product->charactristics->price);
    //    }
    }





    public function add_product(){
        $categories = Category::all();
        return view('admin.add_product' , compact('categories'));
    }

    public function upload_product(Request $request)
    {
        //dd($request);
        $categories = Category::all();
       // dd($categories);
       $this->validate($request, [
          'name' => 'required|string|max:255',
          'description' => 'required|string|max:855',
          'category' =>'required',
          'storage' => 'required',
          'ram' => 'required',
          'Mcamera' =>'required',
          'fcamera'=>'required',
          'os'=>'required',
          'color' => 'required',
          'price' => 'required',
          'quantity'=>'required',
          'images.*' =>'required|mimes:jpeg,png,jpg,gif',
         
    ]);

    
    $product = new Product;
    $product->name = $request->name;
    $product->description = $request->description;
    $product->category_id = $request->category;
    $product->ram = $request->ram;
    $product->storage = $request->storage;
    $product->quantity = $request->quantity;
    $product->main_camera = $request->Mcamera;
    $product->front_camera = $request->fcamera;
    $product->operating_system = $request->os;
    $product->color = $request->color;
    $product->price = $request->price;
    if ($request->file('images')) {
        $product->has_image = 1;
    }else {
        $product->has_image = 0;
    }

    if($request->recommended){
        $product->recommended = 1;
    }else{
        $product->recommended = 0;
    }
    if($request->new_arrival){
        $product->new_arrival = 1;
    }else{
        $product->new_arrival = 0;
    }

    $product->save();
    foreach ($request->file('images') as $imagefile) {
        $image = new ProductImage;
        $path = 'files/';
        $file = $imagefile;
        $file_name = time().'_'.$file->getClientOriginalName();
        $upload = $file->storeAs($path , $file_name , 'public');      
        if($upload){
          $image->product_id = $product->id;
          $image->path = $file_name;
          $image->save();
       }
      }  

      return redirect()->route('admin.products',$product->category_id)->with('success' , 'Product Added Successfully');
}


public function edit_product($id){
    $categories = Category::all();
    $product = Product::findOrFail($id);
    return view('admin.edit_product' , compact('categories','product'));
}


public function delete_image($id){
    //dd($id);
    $image = ProductImage::findOrFail($id);
    $image->delete();
    return redirect()->back();
}

public function edit_upproduct(Request $request , $id){
    $categories = Category::all();
    // dd($categories);
    $this->validate($request, [
       'name' => 'required|string|max:255',
       'description' => 'required|string|max:855',
       'category' =>'required',
       'storage' => 'required',
       'ram' => 'required',
       'Mcamera' =>'required',
       'fcamera'=>'required',
       'os'=>'required',
       'color' => 'required',
       'price' => 'required',
       'quantity'=>'required',
       'images.*' =>'required|mimes:jpeg,png,jpg,gif',
      
 ]);


    $product = Product::find($id);
    $product->name = $request->name;
    $product->description = $request->description;
    $product->category_id = $request->category;
    $product->ram = $request->ram;
    $product->storage = $request->storage;
    $product->main_camera = $request->Mcamera;
    $product->front_camera = $request->fcamera;
    $product->operating_system = $request->os;
    $product->color = $request->color;
    $product->price = $request->price;
    $product->quantity = $request->quantity;

    if ($request->file('images')) {
        $product->has_image = 1;
    }else {
        $product->has_image = 0;
    }

    if($request->recommended){
        $product->recommended = 1;
    }else{
        $product->recommended = 0;
    }
    if($request->new_arrival){
        $product->new_arrival = 1;
    }else{
        $product->new_arrival = 0;
    }

    $product->save();
    if($request->file('images')){
        foreach ($request->file('images') as $imagefile) {
            $image = new ProductImage;
            $path = 'files/';
            $file = $imagefile;
            $file_name = time().'_'.$file->getClientOriginalName();
            $upload = $file->storeAs($path , $file_name , 'public');      
            if($upload){
              $image->product_id = $product->id;
              $image->path = $file_name;
              $image->save();
           }
          } 
    }
 

      return redirect()->route('admin.products',$product->category_id)->with('success' , 'Product Changed Successfully');

}


public function delete_product($id){
    $product = Product::find($id);
    $product->delete();
    return redirect()->back()->with('delete' , 'Product Deleted Successfully');
}


public function get_orders(){
    $categories = Category::all();
    $orders = Order::simplePaginate(10);
    return view('admin.orders',compact('categories','orders'));

}

public function order_details($order_id , $user_id){
    $categories = Category::all();
    $order_details = OrderDetails::where('order_id','=',$order_id)->get();
    return view('admin.order_details',compact('categories','order_details','order_id','user_id'));


}

public function edit_order_item($id , $order_id , $user_id){
    $categories = Category::all();
    $order_item = OrderDetails::findOrFail($id);
    return view('admin.edit_order_item' , compact('categories','order_item','order_id','user_id'));

}
public function delete_order_item($id){
    $order_item = OrderDetails::find($id);
    $quantity = $order_item->quantity;
    $price = $order_item->price;
    $item_id = $id;
    $product = Product::where('id','=',$order_item->product_id)->first();
    $product->quantity = $product->quantity + $quantity;
    $product->save();
    $order = Order::where('id','=',$order_item->order_id)->first();
    $order_item->delete();
    $order->quantity = $order->quantity - $quantity;
    $order->subtotal = $order->subtotal - ($quantity * $price);
    $order->total_price = $order->subtotal + $order->shipping;
    $order->save();

    return redirect()->back()->with('delete' , 'Product Deleted Successfully');

}

public function upload_order_item(Request $request){
    $order_id = $request->order_id;
    $user_id = $request->user_id;
    $categories = Category::all();
    $order_item = OrderDetails::find($request->item_id);
    if($order_item->quantity == (int)$request->quantity) {
        return redirect()->back()->with('caution' , 'Please Change Quantity!');
    }
    $update_quantity_product = Product::where('id','=',$order_item->product_id)->first();
    if ($order_item->quantity >  (int)$request->quantity) {
        //increas whole product quantity
        $difference = $order_item->quantity - (int)$request->quantity;
        $update_quantity_product->quantity = $update_quantity_product->quantity + $difference;
        $update_quantity_product->save();
    }
    else{
        //decreas whole product quantity
        $difference = (int)$request->quantity - $order_item->quantity;
        $update_quantity_product->quantity = $update_quantity_product->quantity - $difference;
        $update_quantity_product->save();
    }


    $new_item_quantity = (int)$request->quantity;
    $order_item->quantity = $new_item_quantity;
    $order_item->save();
    $order = Order::find($order_id);
    $order_new_quantity = OrderDetails::where('order_id','=',$order_id)->get();
    $new_quantity = 0;
    $new_price = 0;
    foreach ($order_new_quantity as $item) {
        $new_quantity = $new_quantity + $item->quantity;
        $new_price = $new_price + ($item->quantity * $item->price);
    }
    $order->subtotal = $new_price;
    $order->total_price = $new_price + $order->shipping;
    $order->quantity = $new_quantity;
    $order->save();
  
    return redirect()->route('admin.order.details',compact('order_id','categories','user_id'))->with('success' , 'Item Quantity Changed Successfully');

}




public function edit_order($id){
    $order=Order::find($id);
    $categories = Category::all();
return view('admin.edit_order',compact('order','categories'));

}

public function upload_order(Request $request){
    $order = Order::find($request->order_id);
    $order->status = $request->status;
    $order->save();
    $categories = Category::all();
    return redirect()->route('admin.orders',compact('categories'));


}


public function delete_order($id){
    $order=Order::find($id);
    $order->delete();
}



////////////////////////////////////////////////////


public function shipping(){
    $categories = Category::all();
    $shippings = Shipping::simplePaginate(10);
    return view('admin.shipping',compact('shippings','categories'));
}


public function add_shipping(Request $request){  //this req came from ajax req that refer to url that refer to this fun

    $shipping = new Shipping();
    $shipping->city = $request->city;
    $shipping->price = $request->cost;
    
    $shipping->save();

}

public function edit_shipping(Request $request , $id){
    $shipping = Shipping::find($id);

    $shipping->city = $request ->input('city');
    $shipping->price = $request ->input('cost');

    $shipping->save();



}




public function remove_shipping($id){
    $shipping = Shipping::findOrFail($id);
    $shipping->delete();

}




public function user_reviews($user_id){
    $categories = Category::all();
    $reviews = UserProductReview::where('user_id','=',$user_id)->simplePaginate(10);
    $username = User::find($user_id);
    return view('admin.user_reviews',compact('reviews','categories','username'));

}

public function remove_review($id){
    $review = UserProductReview::findOrFail($id);
    $review->delete();
}









}