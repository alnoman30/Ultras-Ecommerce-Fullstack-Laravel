<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

use function Flasher\Prime\flash;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::paginate(7);
        return view('pages.admin.sliders', compact('sliders'));
    }

    public function create()
    {
        return view('pages.admin.sliders-create');
    }



    public function store(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'line_one' => 'nullable|string|max:255',
            'line_two' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/sliders'), $imageName); // store in public/uploads/sliders
            $validatedData['image'] = $imageName;
        }


        $record = Slider::create($validatedData);

        flash()->success('Slider created successfully!');

        return redirect()->route('admin.slider', compact('record'));
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('pages.admin.sliders-edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        // Validate request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'line_one' => 'nullable|string|max:255',
            'line_two' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($slider->image && file_exists(public_path('uploads/sliders/' . $slider->image))) {
                unlink(public_path('uploads/sliders/' . $slider->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/sliders'), $imageName); // store in public/uploads/sliders
            $validatedData['image'] = $imageName;
        }

        $slider->update($validatedData);

        flash()->success('Slider updated successfully!');

        return redirect()->route('admin.slider');
    }




    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        // Delete image if it exists
        if ($slider->image && file_exists(public_path('uploads/sliders/' . $slider->image))) {
            unlink(public_path('uploads/sliders/' . $slider->image));
        }

        $slider->delete();

        flash()->success('Slider deleted successfully!');

        return redirect()->route('admin.slider');
    }
}
