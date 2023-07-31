<?php

namespace App\Http\Livewire;

use App\Jobs\AddWatermark;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\RemoveFaces;
use Livewire\Component;
use App\Models\Category;


use App\Jobs\ResizeImage;
use App\Models\Announcement;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;


class AnnouncementEdit extends Component
{   
    use WithFileUploads;
    public $title, $price, $description, $category_id, $images=[], $temporary_images;
    public $imagesFromDb;
    public Announcement $announcement;

    protected $rules = [
        'announcement.title' => 'required|max:100',
        'announcement.price' => 'required|numeric|max_digits:10',
        'announcement.description' => 'required',
        'images.*' => 'image|max:5120',
        'temporary_images.*' => 'image|max:5120',
    ];

    public function mount() {
        $this->imagesFromDb = $this->announcement->images()->get();
    }

    public function update() {
        if (count($this->images)) {
            
            foreach ($this->images as $image) {
                $newFileName = "announcements/{$this->announcement->id}";
                $newImage = $this->announcement->images()->create(['path' => $image->store($newFileName, 'public')]);

                RemoveFaces::withChain([
                    new ResizeImage($newImage->path, 600, 600),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id),
                    new AddWatermark($newImage->id),
                ])->dispatch($newImage->id);            
            }
            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        $this->announcement->save();
        $this->announcement->setAccepted(null);

        session()->flash('edit', 'Annuncio modificato! Sarà pubblicato dopo la revisione!');
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        } else {

        return redirect()->route('users.show', ['user' => Auth::user()->id]);
        }
    }

    public function updatedTemporaryImages() {
        
        if ($this->validate([
            'temporary_images.*' => 'image|max:5120',
        ])) {
        foreach ($this->temporary_images as $image) {
            $this->images[] = $image;
        }
      }
    }



    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function removeImage($key) {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
            
        }
    }

    public function removeImageFromDb($key) {
        if ($this->imagesFromDb->hasAny($key)) {
            $this->imagesFromDb->get($key)->delete();
            $this->imagesFromDb->forget($key);
            
        }
    }
    
    public function render()
    {
        return view('livewire.announcement-edit');
    }
}
