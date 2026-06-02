<x-layouts.guest>
<div class="min-vh-100 w-100 d-flex align-items-center justify-content-center" style="background-color:#2a3f54;">
    <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4 px-3">
        <div class="card shadow rounded-3 border-0">
            <div class="card-body p-4 p-md-4">
                <h4 class="mb-3">Reset Password</h4>
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <form method="POST" action="{{ route('unified.password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3">
                        <label class="form-label"><b>New Password</b></label>
                        <div class="input-group" id="group_new_password">
                            <input type="password" id="inputNewPassword" name="password" class="form-control border-end-0" required>
                            <a href="javascript:void(0);" class="input-group-text bg-transparent" onclick="toggleFieldPassword('inputNewPassword','iconNewPassword')">
                                <i class='bx bx-hide' id="iconNewPassword"></i>
                            </a>
                        </div>
                        @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Confirm Password</b></label>
                        <div class="input-group" id="group_confirm_password">
                            <input type="password" id="inputConfirmPassword" name="password_confirmation" class="form-control border-end-0" required>
                            <a href="javascript:void(0);" class="input-group-text bg-transparent" onclick="toggleFieldPassword('inputConfirmPassword','iconConfirmPassword')">
                                <i class='bx bx-hide' id="iconConfirmPassword"></i>
                            </a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('unified.login') }}">Back to Login</a>
                        <button type="submit" class="btn btn-primary btn-press">Update Password</button>
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
    <script>
        function toggleFieldPassword(inputId, iconId) {
            const field = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (!field || !icon) return;
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('bx-hide');
                icon.classList.add('bx-show');
            } else {
                field.type = 'password';
                icon.classList.remove('bx-show');
                icon.classList.add('bx-hide');
            }
        }
    </script>
</x-layouts.guest>


