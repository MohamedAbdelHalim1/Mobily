<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



class AdminHomeController extends Controller
{
    //


    public function index(){
        $categories = Category::all();
        return view('admin.home' , compact('categories'));
    }


    //////////////////////////// Start User//////////////////////////////////////////

    public function get_users(){
        $categories = Category::all();
        $users = User::all();
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
        $categories = Category::all();
        //dd($categories);
        return view('admin.categories' , compact('categories'));
    }



    public function edit_category(Request $request , $id){
       // dd($request);
        $category = Category::find($id);
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

    }

    public function delete_category($id){
        $category = Category::findOrFail($id);
        $category->delete();

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
       
       

    }



    ////////////////////Start Products///////////////////////////////

    public function get_product($id){
        //dd($id);
       
        $categories = Category::all();
        //dd($categories);
       
        $products = Product::where("category_id" , "=" , $id)->get();

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


}


  