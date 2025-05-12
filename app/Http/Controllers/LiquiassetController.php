<?php

namespace App\Http\Controllers;

// use App\Models\Liquiasset;
// use Illuminate\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Liquiasset;

use Intervention\Image\Facades\Image;

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

        //dd($request->file('job_asset'));
        // dd($request);
        // exit;
        //
        // $request->validate([
        //      'job_asset' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:1024',

        // ]);
        // Create the uploads directory if it doesn't exist
        // $uploadPath = public_path('uploads');
        // if (!file_exists($uploadPath)) {
        //     mkdir($uploadPath, 0755, true);
        // }

        // // Store the image
        // if ($request->file('job_asset')) {
        //    //  $uploadedimage = $request->file('job_asset');
        //    //  //$imageName = time() . '.' . $request->image->extension();
        //    // // $request->image->move($uploadPath, $imageName);
        //    //  $imagename = time() . '.' . $uploadedimage;
        //    //  $request->file('job_asset')->move($uploadPath, $imagename);

        //     $imageName = 'tst'. $request->file('job_asset')->extension();
        //     $request->file('job_asset')->move($uploadPath, $imageName);

     
        //     return redirect()->route('liquiassets.create')
        //         ->with('message', 'Asset Added Successfully');
        //         //->with('image', $imageName);
        // }


        $image = $request->file('job_asset');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        // Resize the image
        //$img = Image::make($image)->resize(300, 200);
        $image->move(public_path('uploads/images/' . $imageName));


        //echo $imageName;

        //dd($imageName);exit;

        Liquiasset::create([
            'job_asset' => $imageName,
            'job_id' => $request->jobid
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
