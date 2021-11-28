<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $category =Category::all();
        return view('admin.category.index',compact('category'));
    }
    public function add()
    {
        return view('admin.category.add');
    }
    public function insert(Request $requets)
    {
        $category = new Category();
        if($requets->hasFile('image'))
        {
            $file = $requets->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category/',$filename);
            $category->image = $filename;
        }
        $category->name = $requets->input('name');
        $category->slug = $requets->input('slug');
        $category->description = $requets->input('description');
        $category->status = $requets->input('status')==TRUE?'1':'0';
        $category->popular = $requets->input('popular')==TRUE?'1':'0';
        $category->meta_title = $requets->input('meta_title');
        $category->meta_description = $requets->input('meta_description');
        $category->meta_keywords = $requets->input('meta_keywords');
        $category->save();
        return redirect('/dashboard')->with('status',"Add successfully");
    }
    public function edit($id)
    {
        $category =Category::find($id);
        return view('admin.category.edit',compact('category'));
    }
    public function update(Request $requets, $id)
    {
        $category = Category::find($id);
        if($requets->hasFile('image')){
            $path='assets/uploads/category/'.$category->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $requets->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category/',$filename);
            $category->image = $filename;
        }
        $category->name = $requets->input('name');
        $category->slug = $requets->input('slug');
        $category->description = $requets->input('description');
        $category->status = $requets->input('status')==TRUE?'1':'0';
        $category->popular = $requets->input('popular')==TRUE?'1':'0';
        $category->meta_title = $requets->input('meta_title');
        $category->meta_description = $requets->input('meta_description');
        $category->meta_keywords = $requets->input('meta_keywords');
        $category->update();
        return redirect('/dashboard')->with('status',"Update successfully");
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category->image)
        {
            $path ='assets/uploads/category'.$category->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            
        }
        $category->delete();
        return redirect('categories')->with('status',"Delete successfully");
    }
    public function s()
    {   
        $s = $_GET['s'];
        $danhmuc =Category::where('name','LIKE','%'.$s.'%')->get();
        return view('admin.category.search',compact('danhmuc'));
    }
}
