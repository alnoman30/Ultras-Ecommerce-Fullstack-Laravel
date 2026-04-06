@extends('layouts.backend')
@section('content')
<div class="main-content">

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Edit Product</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap5">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <a href="{{ route('admin.product') }}">
                            <div class="text-tiny">Products</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <div class="text-tiny">Edit Product</div>
                    </li>
                </ul>
            </div>

            <form class="tf-section-2 form-edit-product" action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="wg-box">
                    <!-- Product Name & Slug -->
                    <fieldset class="name">
                        <div class="body-title mb-10">Product name *</div>
                        <input class="mb-10" type="text" name="name" placeholder="Enter product name" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title mb-10">Slug *</div>
                        <input class="mb-10" type="text" name="slug" placeholder="Enter product slug" value="{{ old('slug', $product->slug) }}" required>
                        @error('slug')
                            <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <!-- Category & Brand -->
                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="body-title mb-10">Category *</div>
                            <div class="select">
                                <select name="category_id" required>
                                    <option disabled>Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                            @enderror
                        </fieldset>

                        <fieldset class="brand">
                            <div class="body-title mb-10">Brand *</div>
                            <div class="select">
                                <select name="brand_id" required>
                                    <option disabled>Choose Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('brand_id')
                                <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>

                    <!-- Short & Full Description -->
                    <fieldset class="shortdescription">
                        <div class="body-title mb-10">Short Description *</div>
                        <textarea class="mb-10 ht-150" name="short_description" required>{{ old('short_description', $product->short_description) }}</textarea>
                        @error('short_description')
                            <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <fieldset class="description">
                        <div class="body-title mb-10">Description *</div>
                        <textarea class="mb-10" name="description" required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>
                </div>

                <div class="wg-box">
                    <!-- Main Image -->
                    <fieldset>
                        <div class="body-title">Upload Main Image *</div>
                        <div class="upload-image flex-grow">

                            <!-- Existing Image -->
                            @if($product->image)
                                <div class="mb-3">
                                    <img src="{{ asset('uploads/products/' . $product->image) }}" class="effect8" style="max-width:200px; border-radius:8px;">
                                </div>
                            @endif

                            <!-- Preview New Image -->
                            <div class="item" id="imgpreview" style="display:none;">
                                <img src="" class="effect8" style="max-width:200px; border-radius:8px;">
                            </div>

                            <!-- Upload -->
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon"><i class="icon-upload-cloud"></i></span>
                                    <span class="body-text">
                                        Drop your image here or 
                                        <span class="tf-color">click to browse</span>
                                    </span>
                                    <input type="file" id="myFile" name="image" accept="image/*" hidden>
                                </label>
                            </div>
                        </div>
                        @error('image')
                            <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <!-- Gallery Images -->
                    <fieldset>
                        <div class="body-title mb-10">Upload Gallery Images</div>
                        <div class="upload-image mb-16" id="gallery-container">

                            <!-- Existing gallery images -->
                            @if($product->images)
                                @foreach(json_decode($product->images, true) as $img)
                                    <div class="item preview-item js-existing">
                                        <img src="{{ asset('uploads/products/' . $img) }}" style="width:100px; height:100px; object-fit:cover; margin:5px; border-radius:4px;">
                                    </div>
                                @endforeach
                            @endif

                            <!-- Upload -->
                            <div id="galUpload" class="item up-load">
                                <label class="uploadfile" for="gFile">
                                    <span class="icon"><i class="icon-upload-cloud"></i></span>
                                    <span class="text-tiny">
                                        Drop your images here or 
                                        <span class="tf-color">click to browse</span>
                                    </span>
                                    <input type="file" id="gFile" name="images[]" multiple accept="image/*" hidden>
                                </label>
                            </div>
                        </div>
                        @error('images')
                            <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <!-- Pricing & Stock -->
                    <div class="cols gap22">
                        <fieldset>
                            <div class="body-title mb-10">Regular Price *</div>
                            <input type="text" name="regular_price" value="{{ old('regular_price', $product->regular_price) }}" required>
                            @error('regular_price')
                                <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                            @enderror
                        </fieldset>

                        <fieldset>
                            <div class="body-title mb-10">Sale Price *</div>
                            <input type="text" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}">
                            @error('sale_price')
                                <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>

                    <div class="cols gap22">
                        <fieldset>
                            <div class="body-title mb-10">SKU *</div>
                            <input type="text" name="SKU" value="{{ old('SKU', $product->SKU) }}" required>
                            @error('SKU')
                                <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                            @enderror
                        </fieldset>

                        <fieldset>
                            <div class="body-title mb-10">Quantity *</div>
                            <input type="text" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
                            @error('quantity')
                                <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>  
                            @enderror
                        </fieldset>
                    </div>

                    <div class="cols gap22">
                        <fieldset>
                            <div class="body-title mb-10">Stock</div>
                            <select name="stock_status">
                                <option value="instock" {{ old('stock_status', $product->stock_status) == 'instock' ? 'selected' : '' }}>InStock</option>
                                <option value="outofstock" {{ old('stock_status', $product->stock_status) == 'outofstock' ? 'selected' : '' }}>Out of Stock</option>
                            </select>
                            @error('stock_status')
                                <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                            @enderror
                        </fieldset>

                        <fieldset>
                            <div class="body-title mb-10">Featured</div>
                            <select name="featured">
                                <option value="0" {{ old('featured', $product->featured) == 0 ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('featured', $product->featured) == 1 ? 'selected' : '' }}>Yes</option>
                            </select>
                            @error('featured')
                                <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>

                    <button class="tf-button w-full" type="submit">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- IMAGE PREVIEW SCRIPT -->
<script>
    // Single Image Preview
    document.getElementById('myFile').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewBox = document.getElementById('imgpreview');
                previewBox.querySelector('img').src = e.target.result;
                previewBox.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    // Multiple Gallery Image Preview
    document.getElementById('gFile').addEventListener('change', function(e) {
        const container = document.getElementById('gallery-container');
        const files = Array.from(e.target.files);

        // Remove previous JS previews only (keep existing images from DB)
        container.querySelectorAll('.preview-item.js-preview').forEach(el => el.remove());

        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.classList.add('item', 'preview-item', 'js-preview');
                div.innerHTML = `<img src="${e.target.result}" style="width:100px; height:100px; object-fit:cover; margin:5px; border-radius:4px;">`;
                container.insertBefore(div, document.getElementById('galUpload'));
            }
            reader.readAsDataURL(file);
        });
    });
</script>

@endsection