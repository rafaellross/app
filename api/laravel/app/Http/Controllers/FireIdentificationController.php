<?php

namespace App\Http\Controllers;

use App\FireIdentification;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;


class FireIdentificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($job)
    {
        
        
        $penetrations =  DB::select(DB::raw(
            "select jobs.description, date_format(fire_identifications.install_dt, '%d/%m/%Y') as formated_date,  fire_identifications.*
            from fire_identifications
            inner join jobs
            on jobs.id = fire_identifications.job_id
            where fire_identifications.fire_photo is not null and fire_identifications.job_id = $job
           order by fire_number
             "));
          
        $compressedPenos = array();



        foreach ($penetrations as $penetration) {

            $img = Image::make($penetration->fire_photo);

            $penetration->fire_photo = $img->fit(200)->encode('data-url')->encoded;                        

            array_push($compressedPenos, $penetration);
        }
        
        // foreach ($penetrations as $penetration) {

        //     $img = Image::make($penetration->fire_photo);
            
        //     $penetration->fire_photo = $img->fit(80)->encode('data-url')->encoded;                        
        //     array_push($compressedPenos, $penetration)
             
        // }
        
             return $compressedPenos;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FireIdentification  $fireIdentification
     * @return \Illuminate\Http\Response
     */
    public function show(FireIdentification $fireIdentification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FireIdentification  $fireIdentification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FireIdentification $fireIdentification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FireIdentification  $fireIdentification
     * @return \Illuminate\Http\Response
     */
    public function destroy(FireIdentification $fireIdentification)
    {
        //
    }
}
