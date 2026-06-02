<div>
    <h2>Register</h2>

    <form wire:submit.prevent="register">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" wire:model="name" class="form-control" id="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" wire:model="email" class="form-control" id="email">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" wire:model="password" class="form-control" id="password">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" wire:model="password_confirmation" class="form-control" id="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
