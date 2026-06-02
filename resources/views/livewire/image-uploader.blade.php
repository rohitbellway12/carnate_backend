<div>
    <div class="d-flex">
        <div>
            <input type="file" wire:model="image" class="form-control">
            <div>
                @error('image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                @if ($successMSG)
                    <span class="text-success">Image Uploaded Successfully!</span>
                @endif
            </div>
        </div>

        @if ($imagePreview)
            <div class="mx-2">
                <a href="{{ $imagePreview }}" download>
                    <img src="{{ $imagePreview }}" alt="Preview" style="max-width: 80px; max-height: 80px;">
                </a>
            </div>
        @endif
        <div>
            <button type="button" wire:click="uploadImage" class="btn btn-primary btn-sm ms-2">
                Upload Image
            </button>
        </div>
    </div>
</div>
