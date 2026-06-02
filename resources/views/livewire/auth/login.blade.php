<div>
    <div class="container-fluid  h-100">
        <div class="row row-cols-1 row-cols-lg-3  row-cols-lg-2 h-100">
            <div class="col mx-auto   d-flex align-items-center justify-content-center  h-100">
                <div class="card bg-white">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('assets/images/carnate.png') }}" class="img-fluid logologin">
                            </a>
                        </div>
                        <div class="text-center pb-1">
                            <h5 class="font-weight-bolder"><b>User Logins</b></h5>
                        </div>
                        <div class="py-4 px-3 rounded">

                            <div class="form-body">
                                <form class="row g-3" wire:submit.prevent="login">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label"><b>Email Address</b></label>
                                        <input type="email" class="form-control" wire:model="email"
                                            id="inputEmailAddress" placeholder="Email Address" value=""
                                            autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label"><b>Enter
                                                Password</b></label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control border-end-0"
                                                placeholder="Password" id="inputChoosePassword" wire:model="password"
                                                autocomplete="password" value=""> <a href="javascript:;"
                                                class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">Remember Me</label>
                                        </div>
                                    </div>
                                    @if (session()->has('error'))
                                        <div class="text-danger mt-2">{{ session('error') }}</div>
                                    @endif
                                    <!-- <div class="col-md-6 text-end"> <a href="#!" class="text-decoration-underline">Forgot
                                                Password ?</a>
                                        </div> -->
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary  py-2">
                                                <h6 class="text-white mb-0">
                                                    <i class="bx bxs-lock-open"></i>Log in <i
                                                        class="st_loader fa-btn-loader bx bx-refresh bx-spin bx-1x "
                                                        style="display:none;"></i>
                                                </h6>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
