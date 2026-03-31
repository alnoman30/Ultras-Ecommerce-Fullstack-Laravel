@extends('layouts.backend')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">

                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Edit Category</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>
                            <a href="{{ route('admin.category') }}">
                                <div class="text-tiny">Categories</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>
                            <div class="text-tiny">Edit Category</div>
                        </li>
                    </ul>
                </div>

                <!-- form -->
                <div class="wg-box">
                    <form class="form-new-product form-style-1" action="{{ route('admin.category.update', $category->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Category Name -->
                        <fieldset class="name">
                            <div class="body-title">Category Name <span class="tf-color-1">*</span></div>
                            <input class="flex-grow" type="text" name="name"
                                value="{{ old('name', $category->name) }}" required>
                        </fieldset>

                        <!-- Category Slug -->
                        <fieldset class="name">
                            <div class="body-title">Category Slug <span class="tf-color-1">*</span></div>
                            <input class="flex-grow" type="text" name="slug"
                                value="{{ old('slug', $category->slug) }}" required>
                        </fieldset>

                        <!-- Image Upload -->
                        <fieldset>
                            <div class="body-title">Upload Image</div>

                            <div class="upload-image flex-grow">

                                <!-- Existing Image -->
                                @if ($category->image)
                                    <div class="mb-3">
                                        <img src="{{ asset($category->image) }}" alt="Category Image" width="120">
                                    </div>
                                @endif

                                <!-- Preview New Image -->
                                <div class="item" id="imgpreview" style="display:none;">
                                    <img src="" class="effect8" style="max-width: 150px; border-radius: 8px;">
                                </div>

                                <!-- Upload -->
                                <div id="upload-file" class="item up-load">
                                    <label class="uploadfile" for="myFile">
                                        <span class="icon">
                                            <i class="icon-upload-cloud"></i>
                                        </span>
                                        <span class="body-text">
                                            Drop your image here or select
                                            <span class="tf-color">click to browse</span>
                                        </span>
                                        <input type="file" id="myFile" name="image" accept="image/*" hidden>
                                    </label>
                                </div>

                            </div>
                        </fieldset>

                        <!-- Submit -->
                        <div class="bot">
                            <div></div>
                            <button class="tf-button w208" type="submit">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="bottom-page">
            <div class="body-text">Copyright © {{ date('Y') }} Ultras Ecommerce</div>
        </div>
    </div>

    <!-- Image Preview Script -->
    <script>
        document.getElementById("myFile").addEventListener("change", function(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const previewBox = document.getElementById("imgpreview");
                    const previewImg = previewBox.querySelector("img");

                    previewImg.src = e.target.result;
                    previewBox.style.display = "block";
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
