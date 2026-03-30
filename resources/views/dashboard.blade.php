@extends('layouts.app')

@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>

    <section class="my-account container">
        <h2 class="page-title">My Account</h2>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <ul class="account-nav">
                    <li><a href="#" class="menu-link menu-link_us-s">Dashboard</a></li>
                    <li><a href="#" class="menu-link menu-link_us-s">Orders</a></li>
                    <li><a href="#" class="menu-link menu-link_us-s">Addresses</a></li>
                    <li><a href="#" class="menu-link menu-link_us-s">Account Details</a></li>
                    <li><a href="#" class="menu-link menu-link_us-s">Wishlist</a></li>

                    <!-- Logout -->
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="#" class="menu-link menu-link_us-s"
                               onclick="confirmLogout(event, this)">
                                Logout
                            </a>
                        </form>
                    </li>
                </ul>
            </div>

            <!-- Content -->
            <div class="col-lg-9">
                <div class="page-content my-account__dashboard">
                    <p>Hello <strong>{{ auth()->user()->name }}</strong></p>

                    <p>
                        From your account dashboard you can view your
                        <a class="underline-link" href="#">recent orders</a>,
                        manage your
                        <a class="underline-link" href="#">shipping addresses</a>,
                        and
                        <a class="underline-link" href="#">edit your password and account details</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection


@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmLogout(event, el) {
    event.preventDefault();

    Swal.fire({
        title: '<span style="font-size: 22px; font-weight: bold;">Are you sure?</span>',
        html: '<span style="font-size: 16px;">You will be logged out!</span>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '<span style="font-size: 16px; font-weight: bold;">Logout</span>',
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
