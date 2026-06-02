<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\UploadImage;
use Illuminate\Support\Str;

class ImageUploader extends Component
{
    use WithFileUploads;

    public $image; 
    public $uploadedImageId;
    public $imagePreview; 

    public $uniqueId; 
    public $successMSG = false;

    public function mount($uniqueId,$preview = null)
    {
        $this->uniqueId = $uniqueId;
        if (!empty($preview)) {
            $this->imagePreview = $preview;
        }
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $this->imagePreview = $this->image->temporaryUrl();
    }

    public function uploadImage()
    {
        $this->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imageName = Str::random(10) . '.' . $this->image->getClientOriginalExtension();

        $this->image->storeAs('uploads', $imageName, 'public_root');

        $uploadedImage = UploadImage::create([
            'file' => 'uploads/' . $imageName,
            'ext' => $this->image->getClientOriginalExtension(),
            'img_id' => 0,
            'delete_code' => "",
            'type' => "",
        ]);

        $this->uploadedImageId = $uploadedImage->id;

        $this->dispatch('imageUploaded', [
            'imageId' => $this->uploadedImageId,
            'uniqueId' => $this->uniqueId,
        ]);
        
        $this->successMSG = true;
    }

    public function render()
    {
        return view('livewire.image-uploader');
    }
}


