<x-layouts.guest>
<div class="min-vh-100 w-100 d-flex align-items-center justify-content-center py-5" style="background: #f7f8fa;">
    <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4 px-3">
        <div class="card shadow-lg rounded-4 border-0" style="overflow: hidden;">
            <div class="card-header bg-dark text-center py-4 border-0" style="background: #0f0f0f !important;">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Carnate" style="max-height: 50px; width: auto; object-fit: contain;">
            </div>
            <div class="card-body p-4 p-md-5">
                <h4 class="fw-bold mb-1" style="color: #111827;">Forgot Password?</h4>
                <p class="text-muted small mb-4">Enter your registered email address to receive a password reset link.</p>

                @if (session('status'))
                    <div class="alert alert-success border-0 rounded-3 py-2 px-3 mb-4" style="background: #ecfdf5; color: #047857; font-size: 13px;">
                        <i class="fa-solid fa-circle-check me-2"></i> {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('unified.password.email') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control form-control-lg carnate-input" placeholder="e.g. name@workshop.com" required autofocus>
                        @error('email')
                            <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('unified.login') }}" class="text-decoration-none fw-semibold" style="color: #64748b; font-size: 13px; transition: color 0.2s ease;">
                            <i class="fa-solid fa-arrow-left me-1"></i> Back to Login
                        </a>
                        <button type="submit" class="btn btn-carnate-red px-4 py-2 fw-bold">
                            Send Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .carnate-input {
        border-radius: 9px;
        border: 1px solid #cbd5e1;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    .carnate-input:focus {
        border-color: #e53935;
        box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.12);
    }
    .btn-carnate-red {
        background-color: #e53935 !important;
        border-color: #e53935 !important;
        color: #ffffff !important;
        border-radius: 9px;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(229, 57, 53, 0.25);
        transition: all 0.2s ease;
    }
    .btn-carnate-red:hover {
        background-color: #c62828 !important;
        border-color: #c62828 !important;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(229, 57, 53, 0.35);
    }
    .btn-carnate-red:active {
        transform: translateY(0);
    }
</style>
</x-layouts.guest>


