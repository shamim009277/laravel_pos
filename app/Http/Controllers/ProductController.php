<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Supplier;
use Illuminate\Http\Request;
use Response;
use Session;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category','supplier')->orderBy('id','DESC')->get();
        return view('products.list',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.add_edit',compact('categories','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[

             'product_name'=>'required',
             'cat_id'=>'required',
             'sup_id'=>'required',
             'product_code'=>'required',
             'product_garage'=>'required',
             'product_image'=>'required | mimes:jpeg,jpg,png,gif |max:1024',
             'buy_date'=>'required',
             'expire_date'=>'required',
             'buying_price'=>'required',
             'selling_price'=>'required',
             
        ]);

        if ($validator->fails()) {    
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(),true);
            foreach($errorMessage as $value){
                $plainErrorText .= $value[0].". ";
            }
            Session::flash('flash_message',$plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }

        $input = $request->all();
        $input['product_name'] = $request->product_name;
        $input['cat_id'] = $request->cat_id;
        $input['sup_id'] = $request->sup_id;
        $input['product_code'] = $request->product_code;
        $input['product_garage'] = $request->product_garage;
        $input['buy_date'] = $request->buy_date;
        $input['expire_date'] = $request->expire_date;
        $input['buying_price'] = $request->buying_price;
        $input['selling_price'] = $request->selling_price;
        
        $image = $request->file('product_image');
        if ($image) {
            $ext = strtolower($image->getClientOriginalExtension());
            $imageName = uniqid().".".$ext;
            $path = 'images/products/';
            $image_url = $path.$imageName;
            $success = $image->move($path,$imageName);
            if ($success) {
                $input['product_image'] = $imageName;
            } else {
                $input['product_image'] = 'default.png';
            }
            
            try {
                $bug = 0;
                $insert = Product::create($input);
                
            } catch (\Exception $e) {
                $bug = $e->errorInfo[1];
            }
            if ($bug==0) {
                Session::flash('flash_message','Product Added Successfully.');
                return redirect('admin/products')->with('status_color','success');
            } else {
                Session::flash('flash_message','Something Error Found');
                return redirect('admin/products')->with('status_color','danger');
            }
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = \Crypt::decrypt($id);
        $single_product = Product::findOrFail($id);
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.add_edit',compact('single_product','categories','suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[

             'product_name'=>'required',
             'cat_id'=>'required',
             'sup_id'=>'required',
             'product_code'=>'required',
             'product_garage'=>'required',
             'product_image'=>'sometimes | required | mimes:jpeg,jpg,png,gif |max:1024',
             'buy_date'=>'required',
             'expire_date'=>'required',
             'buying_price'=>'required',
             'selling_price'=>'required',
             
        ]);

        if ($validator->fails()) {    
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(),true);
            foreach($errorMessage as $value){
                $plainErrorText .= $value[0].". ";
            }
            Session::flash('flash_message',$plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }

        $product = Product::findOrFail($id);
        $input = $request->all();
        $input['product_name'] = $request->product_name;
        $input['cat_id'] = $request->cat_id;
        $input['sup_id'] = $request->sup_id;
        $input['product_code'] = $request->product_code;
        $input['product_garage'] = $request->product_garage;
        $input['buy_date'] = $request->buy_date;
        $input['expire_date'] = $request->expire_date;
        $input['buying_price'] = $request->buying_price;
        $input['selling_price'] = $request->selling_price;

        if ($request->file('product_image') !==($product->product_image)) {
            $image = $request->file('product_image');
            if ($image) {
                $ext = strtolower($image->getClientOriginalExtension());
                $imageName = uniqid().".".$ext;
                $path = 'images/products/';
                $image_url = $path.$imageName;
                $success = $image->move($path,$imageName);
                if ($success) {
                    $old_image = $path.$product->product_image;
                    if (file_exists($old_image)) {
                        @unlink($old_image);
                    }
                    $input['product_image']= $imageName;   
                }   
            } 
            
        } else {
            $input['product_image']= $product->product_image;
        }

        try {
                $bug = 0;
                $product->update($input);
                
            } catch (\Exception $e) {
                $bug = $e->errorInfo[1];
            }
            if ($bug==0) {
                Session::flash('flash_message','Product Updated Successfully.');
                return redirect('admin/products')->with('status_color','success');
            } else {
                Session::flash('flash_message','Something Error Found');
                return redirect('admin/products')->with('status_color','danger');
            }


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
