@extends('layouts.backend')
@section('content') <div class="main-content">

```
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Add Product</h3>
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
                        <div class="text-tiny">Add product</div>
                    </li>
                </ul>
            </div>

            <form class="tf-section-2 form-add-product" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Product name *</div>
                        <input class="mb-10" type="text" name="name" placeholder="Enter product name" required>
                        @error('name')
                            <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title mb-10">Slug *</div>
                        <input class="mb-10" type="text" name="slug" placeholder="Enter product slug" required>
                        @error('slug')
                            <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="body-title mb-10">Category *</div>
                            <div class="select">
                                <select name="category_id">
                                    <option disabled selected>Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                <select name="brand_id">
                                    <option disabled selected>Choose Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('brand_id')
                                <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>

                    <fieldset class="shortdescription">
                        <div class="body-title mb-10">Short Description *</div>
                        <textarea class="mb-10 ht-150" name="short_description" required></textarea>
                        @error('short_description')
                            <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <fieldset class="description">
                        <div class="body-title mb-10">Description *</div>
                        <textarea class="mb-10" name="description" required></textarea>
                        @error('description')
                            <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>
                </div>

                <div class="wg-box">
                    <!-- Main Image -->
                    <fieldset>
                        <div class="body-title">Upload images *</div>
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview" style="display:none"></div>

                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon"><i class="icon-upload-cloud"></i></span>
                                    <span class="body-text">
                                        Drop your images here or 
                                        <span class="tf-color">click to browse</span>
                                    </span>
                                    <input type="file" id="myFile" name="image" accept="image/*">
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
                        <div class="upload-image mb-16">
                            <div id="galUpload" class="item up-load">
                                <label class="uploadfile" for="gFile">
                                    <span class="icon"><i class="icon-upload-cloud"></i></span>
                                    <span class="text-tiny">
                                        Drop your images here or 
                                        <span class="tf-color">click to browse</span>
                                    </span>
                                    <input type="file" id="gFile" name="images[]" multiple accept="image/*">
                                </label>
                            </div>
                        </div>
                        @error('images')
                            <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <div class="cols gap22">
                        <fieldset>
                            <div class="body-title mb-10">Regular Price *</div>
                            <input type="text" name="regular_price" required>
                            @error('regular_price')
                                <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                            @enderror
                        </fieldset>

                        <fieldset>
                            <div class="body-title mb-10">Sale Price *</div>
                            <input type="text" name="sale_price" >
                            @error('sale_price')
                                <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>

                    <div class="cols gap22">
                        <fieldset>
                            <div class="body-title mb-10">SKU *</div>
                            <input type="text" name="SKU" required>
                            @error('SKU')
                                <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                            @enderror
                        </fieldset>

                        <fieldset>
                            <div class="body-title mb-10">Quantity *</div>
                            <input type="text" name="quantity" required>
                            @error('quantity')
                                <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>  
                            @enderror
                        </fieldset>
                    </div>

                    <div class="cols gap22">
                        <fieldset>
                            <div class="body-title mb-10">Stock</div>
                            <select name="stock_status">
                                <option value="instock">InStock</option>
                                <option value="outofstock">Out of Stock</option>
                            </select>
                            @error('stock_status')
                                <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                            @enderror
                        </fieldset>

                        <fieldset>
                            <div class="body-title mb-10">Featured</div>
                            <select name="featured">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            @error('featured')
                                <div class="text-red-500 text-tiny mt-1">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>

                    <button class="tf-button w-full" type="submit">Add product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- IMAGE PREVIEW SCRIPT -->
<script>
    // Single Image Preview
    document.getElementById('myFile').addEventListener('change', function(e) {
        const preview = document.getElementById('imgpreview');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.style.display = 'block';
                preview.innerHTML = `<img src="${e.target.result}" class="effect8">`;
            }
            reader.readAsDataURL(file);
        }
    });

    // Multiple Image Preview
    document.getElementById('gFile').addEventListener('change', function(e) {
        const container = document.querySelector('.upload-image.mb-16');

        // remove old previews
        container.querySelectorAll('.preview-item').forEach(el => el.remove());

        Array.from(e.target.files).forEach(file => {
            const reader = new FileReader();

            reader.onload = function(e) {
                const div = document.createElement('div');
                div.classList.add('item', 'preview-item');

                div.innerHTML = `<img src="${e.target.result}" style="width:100px; height:100px; object-fit:cover; margin:5px;">`;

                container.insertBefore(div, document.getElementById('galUpload'));
            }

            reader.readAsDataURL(file);
        });
    });
</script>
```

@endsection
