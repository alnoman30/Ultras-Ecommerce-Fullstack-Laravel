<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('pages.admin.brand', compact('brands'));
    }

    public function create()
    {
        return view('pages.admin.brand-create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            // Create folder if not exists
            $destinationPath = public_path('uploads/brands');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Generate unique image name
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Move image to public/uploads/brands
            $image->move($destinationPath, $imageName);

            // Save path in database
            $validatedData['image'] = 'uploads/brands/' . $imageName;
        }

        // Create a new brand record in the database
        Brand::create($validatedData);

        flash()->success('Brand created successfully!');

        // Redirect back to the brand index page
        return redirect()->route('admin.brand');
    }


    public function edit($id)
    {
        // Find the brand by ID
        $brand = Brand::findOrFail($id);

        // Return the edit view with the brand data
        return view('pages.admin.brand-edit', compact('brand'));
    }






public function destroy($id)
{
    // Find the brand by ID
    $brand = Brand::findOrFail($id);

    // Delete the image file if exists
    if ($brand->image && file_exists(public_path($brand->image))) {
        unlink(public_path($brand->image));
    }

    // Delete the brand record from the database
    $brand->delete();

    flash()->success('Brand deleted successfully!');

    // Redirect back to the brand index page
    return redirect()->route('admin.brand');
}
}
