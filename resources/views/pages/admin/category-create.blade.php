@extends('layouts.backend')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Category Information</h3>
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
                        <div class="text-tiny">New Category</div>
                    </li>
                </ul>
            </div>

            <!-- form -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <fieldset class="name">
                        <div class="body-title">Category Name <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Category name" name="name" required>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Category Slug <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Category Slug" name="slug" required>
                    </fieldset>

                    <fieldset>
                        <div class="body-title">Upload Image <span class="tf-color-1">*</span></div>

                        <div class="upload-image flex-grow">

                            <!-- Preview -->
                            <div class="item" id="imgpreview" style="display:none;">
                                <img src="" class="effect8" alt="Preview Image" style="max-width: 150px; border-radius: 8px;">
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

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
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
    document.getElementById("myFile").addEventListener("change", function (event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
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