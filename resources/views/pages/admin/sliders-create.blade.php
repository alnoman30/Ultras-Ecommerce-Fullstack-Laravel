@extends('layouts.backend')
@section('content')
<div class="main-content">

    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Slide</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.slider') }}" class="">
                            <div class="text-tiny">Slider</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">New Slide</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" 
                      action="{{ route('admin.slider.store') }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    @csrf

                    <fieldset class="name">
                        <div class="body-title">Title <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Title" name="title" tabindex="0"
                            value="" aria-required="true" required="">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Line 1 <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Line 1" name="line_one" tabindex="0"
                            value="" aria-required="true" required="">
                        @error('line_one')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Line 2 <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Line 2" name="line_two" tabindex="0"
                            value="" aria-required="true" required="">
                        @error('line_two')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <fieldset>
                        <div class="body-title">Upload Image <span class="tf-color-1">*</span></div>
                        <div class="upload-image flex-grow">
                            <div class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">
                                        Drop your image here or select 
                                        <span class="tf-color">click to browse</span>
                                    </span>
                                    <input type="file" id="myFile" name="image" accept="image/*">
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <!-- ✅ Image Preview -->
                        <div style="margin-top:15px;">
                            <img id="previewImage" src="" 
                                 style="max-width: 200px; display:none; border-radius: 8px;">
                        </div>

                    </fieldset>

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
            <!-- /new-category -->
        </div>
        <!-- /main-content-wrap -->
    </div>

    <div class="bottom-page">
        <div class="body-text">Copyright © {{ date('Y') }} Ultras Ecommerce</div>
    </div>
</div>

<!-- Image Preview Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('myFile');
    const preview = document.getElementById('previewImage');

    input.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });
});
</script>

@endsection