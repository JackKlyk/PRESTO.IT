<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image as SpatieImage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class AddWatermark implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $announcement_image_id;
    /**
     * Create a new job instance.
     */
    public function __construct($announcement_image_id)
    {
        $this->announcement_image_id = $announcement_image_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $image = Image::find($this->announcement_image_id);

        if(!$image){
            return;
        }

        $temp = explode('/', $image->path);
        $temp[2] = 'crop_600x600_'.$temp[2];
        $path = implode('/', $temp);
        
        $srcPath = storage_path('app/public/'.$path);
        $image = file_get_contents($srcPath);
        $image = SpatieImage::load($srcPath);

        $image->watermark(base_path('public/img/presto.it_watermark.png'));

        $image->save($srcPath);

    }
}
