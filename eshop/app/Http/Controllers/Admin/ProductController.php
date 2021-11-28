<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use phpDocumentor\Reflection\PseudoTypes\True_;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index',compact('products'));
    }
    public function add()
    {
        $category = Category::all();
        return view('admin.product.add',compact('category'));
    }
    public function insert(Request $requets)
    {
        $products =new Product();
        if($requets->hasFile('image'))
        {
            $file = $requets->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/products/',$filename);
            $products->image = $filename;
        }
        $products->cate_id =$requets->input('cate_id');
        $products->name =$requets->input('name');
        $products->slug =$requets->input('slug');
        $products->small_description =$requets->input('small_description');
        $products->description =$requets->input('description');
        $products->original_price =$requets->input('original_price');
        $products->selling_price =$requets->input('selling_price');
        $products->taxsss =$requets->input('taxsss');
        $products->qty =$requets->input('qty');
        $products->status =$requets->input('status')==TRUE ? '1':'0';
        $products->trending =$requets->input('trending')==TRUE ? '1':'0';
        $products->meta_title =$requets->input('meta_title');
        $products->meta_keywords =$requets->input('meta_keywords');
        $products->meta_description =$requets->input('meta_description');
        $products->save();
        return redirect('products')->with('status',"Add successfully");
    }
    public function edit($id)
    {
        $products = Product::find($id);
        return view('admin.product.edit',compact('products'));
    }
    public function update(Request $requets,$id)
    {
        $products = Product::find($id);
        if($requets->hasFile('image'))
        {
            $path='assets/uploads/products/'.$products->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $requets->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/products/',$filename);
            $products->image = $filename;
        }
       
        $products->name =$requets->input('name');
        $products->slug =$requets->input('slug');
        $products->small_description =$requets->input('small_description');
        $products->description =$requets->input('description');
        $products->original_price =$requets->input('original_price');
        $products->selling_price =$requets->input('selling_price');
        $products->taxsss =$requets->input('taxsss');
        $products->qty =$requets->input('qty');
        $products->status =$requets->input('status')==TRUE ? '1':'0';
        $products->trending =$requets->input('trending')==TRUE ? '1':'0';
        $products->meta_title =$requets->input('meta_title');
        $products->meta_keywords =$requets->input('meta_keywords');
        $products->meta_description =$requets->input('meta_description');
        $products->update();
        return redirect('products')->with('status',"Update successfully");
    }
    public function destroy($id)
    {
        $products = Product::find($id);
        
        $path= 'assets/uploads/products/'.$products->image;
        if(File::exists($path))
        {
            File::delete($path);

        }
        $products->delete();
        return redirect('products')->with('status',"Delete successfully");

    }
    public function s()
    {   
        $s = $_GET['s'];
        $danhmuc =Product::where('name','LIKE','%'.$s.'%')->get();
        return view('admin.product.search',compact('danhmuc'));
    }
}
