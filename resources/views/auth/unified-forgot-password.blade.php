<x-layouts.guest>
<div class="min-vh-100 w-100 d-flex align-items-center justify-content-center" style="background-color:#2a3f54;">
    <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4 px-3">
        <div class="card shadow rounded-3 border-0">
            <div class="card-body p-4 p-md-4">
                <h4 class="mb-3">Forgot Password</h4>
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <form method="POST" action="{{ route('unified.password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label"><b>Email Address</b></label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your registered email" required>
                        @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('unified.login') }}">Back to Login</a>
                        <button type="submit" class="btn btn-primary btn-press">Send Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <style>
        .btn-press { transition: transform 0.06s ease-in-out; }
        .btn-press:active { transform: scale(0.98); }
    </style>
</x-layouts.guest>


