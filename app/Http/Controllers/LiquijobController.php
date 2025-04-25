<?php

namespace App\Http\Controllers;

// use App\Models\Liquijob;
// use Illuminate\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Liquijob;

class LiquijobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $liquijobs = Liquijob::query()
            ->orderBy('created_at', 'DESC')
            ->filter($request->only('filter'))
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Liquijobs/Index', [
            'liquijobs' => $liquijobs,
            'filters' => $request->all('filter'),
            'message' => session('message'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return Inertia::render(
            'Liquijobs/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        // $request->validate([
        //     //'so_number' => ''
        //     //'slug' => 'required|unique:blogs|string|max:255'
        // ]);
        // dd($request);
        // exit;
        // $request->validate([
        //     'liquis_complete_photo' => 'required|file|image|max:1024',
        //     'additional_images' => 'required|file|image|max:1024',
        // ]);
        // $liquis_complete_photo_imagePath = $request->file('liquis_complete_photo')->store('public/images');
        // $additional_images_imagePath = $request->file('additional_images')->store('public/images');
        
        Liquijob::create([
            'so_number' => $request->so_number,
            'building' => $request->building,
            'city' => $request->city,
            'state' => $request->state,
            'status' => $request->status,
            'expected_qty' => $request->expected_qty,
            'serial_number' => $request->serial_number,
            'hid_employee_name' => $request->hid_employee_name,
            'hid_employee_id' => $request->hid_employee_id,
            'liquis_pickup_date' => $request->liquis_pickup_date,
            'liquis_employee_name' => $request->liquis_employee_name,
            'invoice_number' => $request->invoice_number,
            // 'liquis_complete_photo' => $liquis_complete_photo_imagePath,
            // 'additional_images' => $additional_images_imagePath,
            'liquis_complete_photo' => $request->liquis_complete_photo,
            'additional_images' => $request->additional_images,
            'company_name' => $request->company_name,
            'corporate_address' => $request->corporate_address,
            'contact_name' => $request->contact_name,
            'contact_telephone' => $request->contact_telephone,
            'contact_email' => $request->contact_email,
            'location_address' => $request->location_address,
            'start_date' => $request->start_date
        ]);

        return redirect()->route('liquijobs.index')->with('message', 'Job Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Liquijob $liquijob)
    {
        //

        return Inertia::render(
            'Liquijobs/View',
            [
                'liquijobs' => $liquijob
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Liquijob $liquijob)
    {
        //

        return Inertia::render(
            'Liquijobs/Edit',
            [
                'liquijobs' => $liquijob
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Liquijob $liquijob)
    {
        //

        $request->validate([
            'heading' => 'required|string|max:255',
            'slug' => 'required||unique:liquijobs,slug,'.$blog->id.',id|string|max:255'
        ]);
        $liquijob->update([
            'heading' => $request->heading,
            'slug' => Str::slug($request->slug),
            'description' => $request->description
        ]);

        return redirect()->route('liquijobs.index')->with('message', 'Liquijob Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Liquijob $liquijob)
    {
        //
        $blog->delete();
        return redirect()->route('liquijobs.index')->with('message', 'Liquijob Deleted Successfully');
    }
}
