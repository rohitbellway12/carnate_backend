<div class="container-fluid d-flex justify-content-center">
    <div class="card shadow-sm" style="max-width: 36rem; width: 100%;">
        <form wire:submit.prevent="resetpassword">
            <div class="card-header text-center">
                <h5>Reset Password</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label">Current Password<sup class="text-danger">*</sup></label>
                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror"
                        wire:model="current_password" placeholder="Enter Current Password Here...">
                    @error('current_password')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">New Password <sup class="text-danger">*</sup></label>
                    <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Enter New Password Here...">
                    @error('password')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password <sup
                            class="text-danger">*</sup></label>
                    <input type="password" wire:model="password_confirmation" id="password_confirmation"
                        name="password_confirmation" class="form-control"
                        placeholder="Enter Confirm Password Here...">
                    @error('password_confirmation')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary w-100" wire:loading.attr="disabled">
                    Update Password
                    <i class="st_loader spinner-border spinner-border-sm" wire:loading></i>
                </button>
            </div>
        </form>
    </div>
</div>
