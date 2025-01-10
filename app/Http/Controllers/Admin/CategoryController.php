<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {

        $category = Category::latest()->get();
        return view('admin.category.index', compact('category'));
    } // End Method 
    public function AddCategory()
    {
        $id = Auth::user()->id;
        $profileInfo = User::find($id);
        return view('admin.category.create', compact('profileInfo'));
    } // End Method 
    public function StoreCategory(Request $request)
    {

        $filename = null;
        $save_url = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Generate a unique name for the image
            $filename = date('ymdHi') . '_' . $image->getClientOriginalName();

            // Move the image to the desired directory
            $image->move(public_path('uploads/category'), $filename);

            // Correctly format the save URL path
            $save_url = 'uploads/category/' . $filename;
        }

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'image' => $save_url,

        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all.category')->with($notification);
    } // End Method 
    public function EditCategory($id)
    {

        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    } // End Method 

    public function UpdateCategory(Request $request, $id)
    {
        $cat_id = Category::findOrFail($id);
    
        // Initialize the filename and save URL
        $filename = $cat_id->image; // Lưu tên tệp cũ
        $save_url = $cat_id->image;  // Lưu đường dẫn cũ
    
        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            // Remove old image file if it exists
            if ($cat_id->image && file_exists(public_path($cat_id->image))) {
                unlink(public_path($cat_id->image));
            }
    
            $image = $request->file('image');
            // Generate a unique name for the new image
            $filename = date('ymdHi') . '_' . $image->getClientOriginalName();
    
            // Move the image to the desired directory
            $image->move(public_path('uploads/category'), $filename);
    
            // Update the save URL with the new image path
            $save_url = 'uploads/category/' . $filename;
        }
    
        // Update category data
        $cat_id->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'image' => $save_url,
        ]);
    
        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('admin.all.category')->with($notification);
    }
    public function DeleteCategory($id) {
        $item = Category::find($id);
        
        if ($item) {
            $img = $item->image;
    
            // Kiểm tra xem file có tồn tại không trước khi xóa
            if ($img && file_exists(public_path($img))) {
                unlink(public_path($img));
            }
    
            $item->delete();
    
            $notification = array(
                'message' => 'Category Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Category Not Found',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    

}// End Method 
