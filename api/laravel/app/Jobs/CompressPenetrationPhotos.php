<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Intervention\Image\ImageManagerStatic as Image;

class CompressPenetrationPhotos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //$penetrations = \App\FireIdentification::whereNotNull('fire_photo')->take(1)->get();
        $penetration = \App\FireIdentification::find(5821)->get();
        $img = Image::make($penetration->fire_photo);
            
        $penetration->photo_to_print = $img->fit(80)->encode('data-url')->encoded;                        
        $penetration->save();
    
        
        return "Updated " . count($penetration) . " Photos";
                
    }
}
