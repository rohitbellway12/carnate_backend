<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="{{ 'resetpassword' }}">
                @csrf
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group mt-2">
                            <label class="form-label">Old Password<sup class="text-danger">*</sup></label>
                            <input type="password" name="name" class="form-control" wire:model="old_password"
                                placeholder="Enter password ..." value="">
                            @error('old_password')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group mt-2">
                            <label class="form-label">New Password <sup class="text-danger">*</sup></label>
                            <input type="text" wire:model="password" class="form-control" placeholder="Enter password ..."
                                value="">
                            @error('password')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group mt-2">
                            <div class="form-group mt-2">
                                <label class="form-label">Confirm Password <sup class="text-danger">*</sup></label>
                                <input type="text" wire:model="confirmed" class="form-control" placeholder="Enter password ..."
                                    value="">
                                @error('confirmed')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save <i
                            class="st_loader spinner-border spinner-border-sm" style="display:none;"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
