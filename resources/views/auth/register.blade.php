@extends('layouts.app')

@section('content')
<main class="pt-90">
  <div class="mb-4 pb-4"></div>

  <section class="login-register container">
    <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link nav-link_underscore active" id="register-tab" data-bs-toggle="tab"
          href="#tab-item-register" role="tab">Register</a>
      </li>
    </ul>

    <div class="tab-content pt-2">
      <div class="tab-pane fade show active" id="tab-item-register">
        <div class="register-form">

          <form method="POST" action="{{ route('register') }}" class="needs-validation">
            @csrf

            <div class="form-floating mb-3">
              <input type="text"
                     name="name"
                     class="form-control form-control_gray"
                     value="{{ old('name') }}"
                     required autofocus>
              <label>Name</label>

              @error('name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="pb-3"></div>

            <div class="form-floating mb-3">
              <input type="email"
                     name="email"
                     class="form-control form-control_gray"
                     value="{{ old('email') }}"
                     required>
              <label>Email address *</label>

              @error('email')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="pb-3"></div>

            <div class="form-floating mb-3">
              <input type="password"
                     name="password"
                     class="form-control form-control_gray"
                     required>
              <label>Password *</label>

              @error('password')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="form-floating mb-3">
              <input type="password"
                     name="password_confirmation"
                     class="form-control form-control_gray"
                     required>
              <label>Confirm Password *</label>
            </div>

            <div class="d-flex align-items-center mb-3 pb-2">
              <p class="m-0">
                Your personal data will be used to support your experience throughout this website,
                to manage access to your account, and for other purposes described in our privacy policy.
              </p>
            </div>

            <button class="btn btn-primary w-100 text-uppercase" type="submit">
              Register
            </button>

            <div class="customer-option mt-4 text-center">
              <span class="text-secondary">Have an account?</span>
              <a href="{{ route('login') }}" class="btn-text">
                Login to your Account
              </a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </section>
</main>
@endsection
