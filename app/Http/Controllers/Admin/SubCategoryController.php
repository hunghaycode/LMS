<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(){

        $subCategory = SubCategory::latest()->get();
        return view('admin.sub_category.index',compact('subCategory'));

    }// End Method 
    
    public function create(){

        $category = Category::latest()->get();
        return view('admin.sub_category.create',compact('category'));

    }// End Method 


    public function store(Request $request){ 

        SubCategory::insert([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
            'sub_category_slug' => strtolower(str_replace(' ','-',$request->sub_category_name)), 

        ]);

        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all.subcategory')->with($notification);  

    }// End Method 
    public function EditSubCategory($id){

        $category = Category::latest()->get();
        $subcategory = SubCategory::find($id);
        return view('admin.sub_category.edit',compact('category','subcategory'));

    }// End Method


    public function UpdateSubCategory(Request $request){ 

        $subcat_id = $request->id;

        SubCategory::find($subcat_id)->update([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
            'sub_category_slug' => strtolower(str_replace(' ','-',$request->sub_category_name)), 

        ]);

        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all.subcategory')->with($notification);  

    }// End Method 


    public function DeleteSubCategory($id){

        SubCategory::find($id)->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 



}
