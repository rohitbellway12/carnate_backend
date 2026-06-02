<x-layouts.guest>
<div class="min-vh-100 w-100 d-flex align-items-center justify-content-center" style="background-color:#2a3f54;">
    <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4 px-3">
        <div class="card shadow rounded-3 border-0">
            <div class="card-body text-center p-4 p-md-4">
                <h4 class="mb-3">Invalid or Expired Link</h4>
                <p class="text-muted">The password reset link is invalid, expired, or already used.</p>
                <a href="{{ route('unified.password.request') }}" class="btn btn-primary btn-press">Request New Link</a>
            </div>
        </div>
    </div>
    </div>
    <style>
        .btn-press { transition: transform 0.06s ease-in-out; }
        .btn-press:active { transform: scale(0.98); }
    </style>
</x-layouts.guest>


