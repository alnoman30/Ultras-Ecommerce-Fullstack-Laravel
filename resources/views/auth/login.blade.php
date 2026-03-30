@extends('layouts.app')

@section('content')
<main class="pt-90">
  <div class="mb-4 pb-4"></div>

  <section class="login-register container">
    <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link nav-link_underscore active" id="login-tab" data-bs-toggle="tab"
          href="#tab-item-login" role="tab">Login</a>
      </li>
    </ul>

    <div class="tab-content pt-2">
      <div class="tab-pane fade show active" id="tab-item-login">
        <div class="login-form">

          <form method="POST" action="{{ route('login') }}" class="needs-validation">
            @csrf

            <div class="form-floating mb-3">
              <input type="email"
                     name="email"
                     class="form-control form-control_gray"
                     value="{{ old('email') }}"
                     required autofocus>
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

            <div class="form-check mb-3">
              <input type="checkbox" name="remember" class="form-check-input" id="remember_me">
              <label class="form-check-label" for="remember_me">Remember me</label>
            </div>

            <button class="btn btn-primary w-100 text-uppercase" type="submit">
              Log In
            </button>

            <div class="customer-option mt-4 text-center">
              <span class="text-secondary">No account yet?</span>

              <a href="{{ route('register') }}" class="btn-text">
                Create Account
              </a>

              |

              @auth
                  <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}" class="btn-text">
                My Account
              </a>
              @endauth

            </div>

            @if (Route::has('password.request'))
              <div class="text-center mt-2">
                <a href="{{ route('password.request') }}" class="btn-text">
                  Forgot your password?
                </a>
              </div>
            @endif

          </form>

        </div>
      </div>
    </div>
  </section>
</main>
@endsection
