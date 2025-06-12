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
}
