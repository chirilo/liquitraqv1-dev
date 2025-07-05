<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alimranahmed\LaraOCR\Facades\OCR;

use Illuminate\Support\Str;
use Inertia\Inertia;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\File;

use Intervention\Image\Facades\Image;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Illuminate\Support\Facades\Redirect;

class OcrController extends Controller
{
    //
    public function make(Request $request)
    {

        //dd($request->file('job_asset'));

        // process job assets make
        $image = $request->file('job_asset');
        $fname = $request->file('job_asset')->getClientOriginalName();
        $storagePath = Storage::disk('public')->put('job_assets_make', $image);
        $storageName = basename($storagePath);

        //dd($storageName);

        //$imagePath = public_path('images/8055.png');
        //$imagePath = public_path('8055.png');
        //$imagePath = public_path('howareyoupng.png');
        $imagePath = 'storage/job_assets_make/'.$storageName;
        //$imagePath = 'storage/job_assets_make/viJ8NOF2inXw4u7qB9VAfNjNoz02L5CneYRkDnNL.png';

        $ocrText = OCR::scan($imagePath);
        return back()->with('flash', [
            'message' => $ocrText,
        ]);
    }

    //
    public function model(Request $request)
    {

        //dd($request->file('job_asset'));

        // process job assets make
        $image = $request->file('job_asset');
        $fname = $request->file('job_asset')->getClientOriginalName();
        $storagePath = Storage::disk('public')->put('job_assets_model', $image);
        $storageName = basename($storagePath);

        //dd($storageName);

        //$imagePath = public_path('images/8055.png');
        //$imagePath = public_path('8055.png');
        //$imagePath = public_path('howareyoupng.png');
        $imagePath = 'storage/job_assets_model/'.$storageName;
        //$imagePath = 'storage/job_assets_make/viJ8NOF2inXw4u7qB9VAfNjNoz02L5CneYRkDnNL.png';

        $ocrText = OCR::scan($imagePath);
        return back()->with('flash', [
            'message' => $ocrText,
        ]);
    }

    //
    public function serial(Request $request)
    {

        //dd($request->file('job_asset'));

        // process job assets make
        $image = $request->file('job_asset');
        $fname = $request->file('job_asset')->getClientOriginalName();
        $storagePath = Storage::disk('public')->put('job_assets_serial', $image);
        $storageName = basename($storagePath);

        //dd($storageName);

        //$imagePath = public_path('images/8055.png');
        //$imagePath = public_path('8055.png');
        //$imagePath = public_path('howareyoupng.png');
        $imagePath = 'storage/job_assets_serial/'.$storageName;
        //$imagePath = 'storage/job_assets_make/viJ8NOF2inXw4u7qB9VAfNjNoz02L5CneYRkDnNL.png';

        $ocrText = OCR::scan($imagePath);
        return back()->with('flash', [
            'message' => $ocrText,
        ]);
    }


    // full image
    public function full(Request $request)
    {

        //dd($request->file('job_asset'));

        // process job assets make
        $image = $request->file('job_asset');
        $fname = $request->file('job_asset')->getClientOriginalName();
        $storagePath = Storage::disk('public')->put('job_assets_full', $image);
        $storageName = basename($storagePath);

        //dd($storageName);

        $imagePath = 'storage/job_assets_full/'.$storageName;
        //$imagePath = 'storage/job_assets_make/viJ8NOF2inXw4u7qB9VAfNjNoz02L5CneYRkDnNL.png';

        $ocrText = OCR::scan($imagePath);

        //dd($ocrText);
        $explodedocrtext = explode("\n", $ocrText);


        //dd($explodedocrtext);
        $newarray = [];
        foreach( $explodedocrtext as $k => $t ){
            if( str_contains($t, 'Category') ){
               // $t = str_replace(' ', '', $t);
                $t = str_replace(' : ', '', $t);
                $t = str_replace(' = ', '', $t);
                $t = str_replace(' > ', '', $t);
                $t = str_replace(' * ', '', $t);
                $t = str_replace("'", '', $t);
                $t = str_replace('Category', '', $t);
                $t = strtolower($t);
                if( str_contains($t, 'infrastructure') ){
                    $t = 'infrastructure';
                }
                else if ( str_contains($t, 'furniture') ) {
                    $t = 'furniture';
                }
                else if ( str_contains($t, 'it') ) {
                    $t = 'it';
                }
                $newarray['category'] = $t;
            }

            if( str_contains($t, 'Type') ){

                //$t = str_replace(' ', '', $t);
                $t = str_replace(' : ', '', $t);
                $t = str_replace(' + ', '', $t);
                $t = str_replace('-', '', $t);
                $t = str_replace(' = ', '', $t);
                $t = str_replace(' ', '', $t);
                $t = str_replace(',', '', $t);
                $t = str_replace('>', '', $t);
                 $t = str_replace(' * ', '', $t);
                $t = str_replace('Type', '', $t);
                $t = strtolower($t);
                //dd($t);
                $newarray['type'] = $t;
            }

            if( str_contains($t, 'Make') ){
                $t = str_replace('Make : ', '', $t);
                //$t = str_replace(' ', '', $t);
                $t = str_replace(' : ', '', $t);
                $t = str_replace(' = ', '', $t);
                $t = str_replace(' > ', '', $t);
                $t = str_replace('Make', '', $t);
                $newarray['make'] = $t;
            }

            if( str_contains($t, 'Model') ){
                $t = str_replace('Model : ', '', $t);
               // $t = str_replace(' ', '', $t);
                $t = str_replace(' : ', '', $t);
                $t = str_replace(' = ', '', $t);
                $t = str_replace(' > ', '', $t);
                $t = str_replace('Model', '', $t);
                $newarray['model'] = $t;
            }

            if( str_contains($t, 'Serial') ){
                $t = str_replace('Serial >  ', '', $t);
                //$t = str_replace(' ', '', $t);
                $t = str_replace(' : ', '', $t);
                $t = str_replace(' = ', '', $t);
                $t = str_replace(' > ', '', $t);
                $t = str_replace('Serial', '', $t);
                $newarray['serial'] = $t;
            }

            if( str_contains($t, 'Quantity') ){

                $t = str_replace('Quantity 2 ', '', $t);
                $t = str_replace('Quantity > ', '', $t);
                //$t = str_replace(' ', '', $t);
                $t = str_replace(' : ', '', $t);
                $t = str_replace(' = ', '', $t);
                $t = str_replace(' > ', '', $t);
                 $t = str_replace(' * ', '', $t);
                $t = str_replace('Quantity', '', $t);
                //dd($t);
                $newarray['quantity'] = $t;
            }

            if( str_contains($t, 'WeightEach') || str_contains($t, 'Weight Each') ){
                $t = str_replace('WeightEach : ', '', $t);
                //$t = str_replace(' ', '', $t);;
                $t = str_replace(' : ', '', $t);
                $t = str_replace(' = ', '', $t);
                $t = str_replace(' > ', '', $t);
                 $t = str_replace(' * ', '', $t);
                $t = str_replace('WeightEach', '', $t);
                $newarray['weighteach'] = $t;
            }

            if( str_contains($t, 'Description') ){
                $t = str_replace('Description', '', $t);
                $t = str_replace(' : ', '', $t);
                $t = str_replace(' = ', '', $t);
                $t = str_replace(' > ', '', $t);
                $t = str_replace(' * ', '', $t);
                $t = str_replace('Description', '', $t);
                $newarray['description'] = $explodedocrtext[$k+2];
            }

            if( str_contains($t, 'Status') ){
                $t = str_replace('Status : ', '', $t);
                $t = str_replace(' ', '', $t);
                $t = str_replace(' : ', '', $t);
                $t = str_replace(' = ', '', $t);
                $t = str_replace(' > ', '', $t);
                $t = str_replace(' * ', '', $t);
                $t = str_replace('Status', '', $t);
                $t = strtolower($t);
                $newarray['status'] = $t;
            }

            if( str_contains($t, 'Asset Disposition') || str_contains($t, 'Asset Dispostion') ){
                //dd($t);
                $t = str_replace('.', '', $t);
                $t = str_replace('Asset Disposition', '', $t);
                $t = str_replace('Asset Dispostion', '', $t);
                $t = str_replace(' ', '', $t);
                $t = str_replace(' : ', '', $t);
                $t = str_replace(' = ', '', $t);
                $t = str_replace(' > ', '', $t);
                $t = str_replace(' * ', '', $t);
                
                $t = strtolower($t);
                $newarray['assetdisposition'] = $t;
            }

            // for extended readings of ocr
            if( str_contains($t, 'Infrastructure') || str_contains($t, 'furniture') || str_contains($t, 'IT') ){
                $newarray['category'] = strtolower($t);
            }
            if( str_contains($t, 'Work In Progress') || str_contains($t, 'Original State') || str_contains($t, 'Completed') ){
                $t = str_replace(' ', '', $t);
                $newarray['status'] = strtolower($t);
            }

            // if( $k > 25 ){
            //     dd($k);
            //     if($k == 20 ){
            //         $newarray['type'] = $explodedocrtext[$k];
            //     }
                
            // }
            if( count($explodedocrtext) > 25 ){
                if( $k == 20 && !$newarray['type'] ){
                    $explodedocrtext[$k] = strtolower($explodedocrtext[$k]);
                    $explodedocrtext[$k] = str_replace(',', '', $explodedocrtext[$k]);
                    $explodedocrtext[$k] = str_replace('-', '', $explodedocrtext[$k]);
                    $explodedocrtext[$k] = str_replace(' ', '', $explodedocrtext[$k]);
                    //$explodedocrtext[$k] = str_replace(',', '', $explodedocrtext[$k]);
                    $newarray['type'] = $explodedocrtext[$k];
                }

                if($k == 22 && !$newarray['quantity'] ){
                    $newarray['quantity'] = $explodedocrtext[$k];
                }

                if($k == 24 && !$newarray['make'] ){
                    $newarray['make'] = $explodedocrtext[$k];
                }

                if($k == 26 && !$newarray['model'] ){
                    $newarray['model'] = $explodedocrtext[$k];
                }

                if($k == 28 && !$newarray['serial'] ){
                    $newarray['serial'] = $explodedocrtext[$k];
                }

                if($k == 30 && !$newarray['weighteach'] ){
                    $newarray['weighteach'] = $explodedocrtext[$k];
                }

                if($k == 32 && !$newarray['description'] ){
                    $newarray['description'] = $explodedocrtext[$k];
                }
            }
            

        }
        //dd($newarray);

        return back()->with('flash', [
            //'message' => $ocrText,
            'message' => $newarray,
        ]);
    }
}
