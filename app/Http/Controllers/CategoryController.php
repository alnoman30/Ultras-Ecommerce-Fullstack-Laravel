<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(7);
        return view('pages.admin.categories', compact('categories'));
    }


    public function create()
    {
        return view('pages.admin.category-create');
    }


    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = $request->input('slug');
        $slug = str_replace(' ', '-', $slug);
        $validatedData['slug'] = $slug;

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            // Create folder if not exists
            $destinationPath = public_path('uploads/categories');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Generate unique image name
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $validatedData['image'] = 'uploads/categories/' . $imageName;
        }

        Category::create($validatedData);

        flash()->success('Category created successfully!');

        return redirect()->route('admin.category');
    }


    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.admin.category-edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = $request->input('slug');
        $slug = str_replace(' ', '-', $slug);
        $validatedData['slug'] = $slug;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $image = $request->file('image');

            // Create folder if not exists
            $destinationPath = public_path('uploads/categories');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Generate unique image name
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $validatedData['image'] = 'uploads/categories/' . $imageName;
        }

        $category->update($validatedData);

        flash()->success('Category updated successfully!');

        return redirect()->route('admin.category');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete image if exists
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }

        $category->delete();

        flash()->success('Category deleted successfully!');

        return redirect()->route('admin.category');
    }
}
