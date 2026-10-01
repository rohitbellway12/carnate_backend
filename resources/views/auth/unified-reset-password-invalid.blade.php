<x-layouts.guest>
<div class="min-vh-100 w-100 d-flex align-items-center justify-content-center py-5" style="background: #f7f8fa;">
    <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4 px-3">
        <div class="card shadow-lg rounded-4 border-0" style="overflow: hidden;">
            <div class="card-header bg-dark text-center py-4 border-0" style="background: #0f0f0f !important;">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Carnate" style="max-height: 50px; width: auto; object-fit: contain;">
            </div>
            <div class="card-body text-center p-4 p-md-5">
                <div class="mb-3 text-danger">
                    <i class="fa-solid fa-circle-xmark fa-3x"></i>
                </div>
                <h4 class="fw-bold mb-2" style="color: #111827;">Invalid or Expired Link</h4>
                <p class="text-muted small mb-4">The password reset link is invalid, expired, or has already been used.</p>
                <a href="{{ route('unified.password.request') }}" class="btn btn-carnate-red px-4 py-2 fw-bold text-decoration-none">
                    Request New Link
                </a>
            </div>
        </div>
    </div>
</div>

<style>
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
</style>
</x-layouts.guest>


