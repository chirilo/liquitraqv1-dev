<?php

namespace App\Http\Controllers;

// use App\Models\Liquiasset;
// use Illuminate\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Liquiasset;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\File;

use Intervention\Image\Facades\Image;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class LiquiassetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inertia::render(
            'Liquiassets/Index'
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $_GET data
        $jobid = $_GET['jobid'];

        //dd($jobid);exit;
        //
        return Inertia::render('Liquiassets/Create', [
                'jobid' => $jobid,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request);
        // exit;

        $image = $request->file('job_asset');
        $fname = $request->file('job_asset')->getClientOriginalName();

        //Storage::disk('local')->put('file.txt', 'Contents'); // sucess
        // $jobasset_img = $request->file('job_asset');
        // $jobasset_filename = $jobasset_img->getClientOriginalName() . '.' . $jobasset_img->getClientOriginalExtension();
        // Storage::disk('public')->putFileAs('aplods', $jobasset_img, $jobasset_filename);


        $storagePath = Storage::disk('public')->put('job_assets', $image);
        $storageName = basename($storagePath);
       

        Liquiasset::create([
            'job_asset' => '/storage/job_assets/'.$storageName,
            'job_id' => $request->jobid,
            'asset_category' => $request->asset_category,
            'asset_quantity' => $request->asset_quantity,
            'asset_type' => $request->asset_type,
            'asset_make' => $request->asset_make,
            'asset_model' => $request->asset_model,
            'asset_serial' => $request->asset_serial,
            'asset_weight_each' => $request->asset_weight_each,
            'asset_description' => $request->asset_description,
            'asset_status' => $request->asset_status,
        ]);

        return redirect()->route('liquijobs.index')->with('message', 'Asset Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Liquiasset $liquiasset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Liquiasset $liquiasset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Liquiasset $liquiasset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Liquiasset $liquiasset)
    {
        //
    }
}
