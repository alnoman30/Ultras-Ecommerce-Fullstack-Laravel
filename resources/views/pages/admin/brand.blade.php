@extends('layouts.backend')
@section('content')
    <div class="main-content">

        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Brands</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Brands</div>
                        </li>
                    </ul>
                </div>

                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                            <form class="form-search">
                                <fieldset class="name">
                                    <input type="text" placeholder="Search here..." class="" name="name"
                                        tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                                <div class="button-submit">
                                    <button class="" type="submit"><i class="icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <a class="tf-button style-1 w208" href="{{ route('admin.brand.create') }}"><i
                                class="icon-plus"></i>Add new</a>
                    </div>
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Products</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="pname">
                                                <div class="image">
                                                    <img src="{{ asset($brand->image) }}" alt="" class="image">
                                                </div>
                                                <div class="name">
                                                    <a href="#" class="body-title-2">{{ $brand->name }}</a>
                                                </div>
                                            </td>
                                            <td>{{ $brand->slug }}</td>
                                            <td><a href="#" target="_blank">{{ $brand->products_count }}</a></td>
                                            <td>
                                                <div class="list-icon-function">
                                                    <a href="{{ route('admin.brand.edit', $brand->id) }}" class="item edit">
                                                        <div class="item edit">
                                                            <i class="icon-edit-3"></i>
                                                        </div>
                                                    </a>
                                                    <form action="{{ route('admin.brand.destroy', $brand->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="button" onclick="confirmDelete(event, this)"
                                                            class="item text-danger delete"
                                                            style="border:none; padding:0; background:none;">
                                                            <i class="icon-trash-2"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="divider"></div>

                    </div>
                    <div class=" pagination flex items-center justify-end gap10">
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
        </div>


        <div class="bottom-page">
            <div class="body-text">Copyright © {{ date('Y') }} Ultras Ecommerce</div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(event, el) {
            event.preventDefault();

            Swal.fire({
                title: '<span style="font-size: 22px; font-weight: bold;">Are you sure?</span>',
                html: '<span style="font-size: 16px;">This brand will be deleted permanently!</span>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<span style="font-size: 16px; font-weight: bold;">Delete</span>',
                cancelButtonText: '<span style="font-size: 16px;">Cancel</span>',
                reverseButtons: true,
                confirmButtonColor: '#b9a16b',
                cancelButtonColor: 'rgb(5, 5, 5)',
                width: '450px',
                padding: '2.5em',
                customClass: {
                    popup: 'swal-popup-custom',
                    confirmButton: 'swal-btn-confirm',
                    cancelButton: 'swal-btn-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    el.closest('form').submit();
                }
            });
        }
    </script>
@endpush
