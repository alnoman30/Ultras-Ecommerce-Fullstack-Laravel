<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount('products')->paginate(7);
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

        $slug = $request->input('slug');
        $slug = str_replace(' ', '-', $slug);
        $validatedData['slug'] = $slug;

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            // Create folder if not exists
            $destinationPath = public_path('uploads/brands');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Generate unique image name
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $validatedData['image'] = 'uploads/brands/' . $imageName;
        }

        Brand::create($validatedData);

        flash()->success('Brand created successfully!');

        return redirect()->route('admin.brand');
    }


    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('pages.admin.brand-edit', compact('brand'));
    }



    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands,slug,' . $brand->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = $request->input('slug');
        $slug = str_replace(' ', '-', $slug);
        $validatedData['slug'] = $slug;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($brand->image && file_exists(public_path($brand->image))) {
                unlink(public_path($brand->image));
            }

            $image = $request->file('image');

            // Create folder if not exists
            $destinationPath = public_path('uploads/brands');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Generate unique image name
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $validatedData['image'] = 'uploads/brands/' . $imageName;
        }

        $brand->update($validatedData);

        flash()->success('Brand updated successfully!');

        return redirect()->route('admin.brand');
    }






    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        if ($brand->image && file_exists(public_path($brand->image))) {
            unlink(public_path($brand->image));
        }

        $brand->delete();

        flash()->success('Brand deleted successfully!');

        return redirect()->route('admin.brand');
    }
}
