<?php

namespace App\Http\Controllers;

// use App\Models\Liquijob;
// use Illuminate\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Liquijob;
use App\Models\Liquiasset;

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

        // check if $_GET data is present
        if( isset($_GET['caddress']) || isset($_GET['cemail']) || isset($_GET['cname']) || isset($_GET['coname']) || isset($_GET['loaddress']) || isset($_GET['sdate']) ) {
            // id index exists
            $caddress = $_GET['caddress'];
            $cemail = $_GET['cemail'];
            $cname = $_GET['cname'];
            $coname = $_GET['coname'];
            $loaddress = $_GET['loaddress'];
            $sdate = $_GET['sdate'];
        }

        $server_data = json_encode([
            'caddress' => $caddress,
                'cemail' => $cemail,
                'cname' => $cname,
                'coname' => $coname,
                'loaddress' => $loaddress,
                'caddress' => $sdate,
        ]);
        //

        //dd($caddress);

        //Inertia::share('caddress', $caddress);

        return Inertia::render(
            'Liquijobs/Create',
            [
                'caddress' => $caddress,
                'cemail' => $cemail,
                'cname' => $cname,
                'coname' => $coname,
                'loaddress' => $loaddress,
                'sdate' => $sdate,
                'serverdata' => $server_data
            ]
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
        

        // dd($request);
        // exit;
        // $request->validate([
        //     'type' => 'required|string|max:255'
        // ]);
        Liquijob::create([
            'company_name' => $request->company_name,
            'corporate_address' => $request->corporate_address,
            'contact_name' => $request->contact_name,
            'contact_telephone' => $request->contact_telephone,
            'contact_email' => $request->contact_email,
            'location_address' => $request->location_address,
            'start_date' => $request->start_date,
            'type' => $request->type,

            'so_number' => 1,
            'building' => $request->location_address,
            'city' => '1',
            'state' => '1',
            'status' => 'Work in Progress',
            'expected_qty' => '1',
            'serial_number' => '1',
            'hid_employee_name' => '1',
            'hid_employee_id' => '1',
            'liquis_pickup_date' => '1',
            'liquis_employee_name' => '1',
            'invoice_number' => '1',

        ]);

        // Liquijob::create([
        //     'so_number' => $request->so_number,
        //     'building' => $request->building,
        //     'city' => $request->city,
        //     'state' => $request->state,
        //     'status' => $request->status,
        //     'expected_qty' => $request->expected_qty,
        //     'serial_number' => $request->serial_number,
        //     'hid_employee_name' => $request->hid_employee_name,
        //     'hid_employee_id' => $request->hid_employee_id,
        //     'liquis_pickup_date' => $request->liquis_pickup_date,
        //     'liquis_employee_name' => $request->liquis_employee_name,
        //     'invoice_number' => $request->invoice_number,
        //     // 'liquis_complete_photo' => $liquis_complete_photo_imagePath,
        //     // 'additional_images' => $additional_images_imagePath,
        //     'liquis_complete_photo' => $request->liquis_complete_photo,
        //     'additional_images' => $request->additional_images,
        //     'company_name' => $request->company_name,
        //     'corporate_address' => $request->corporate_address,
        //     'contact_name' => $request->contact_name,
        //     'contact_telephone' => $request->contact_telephone,
        //     'contact_email' => $request->contact_email,
        //     'location_address' => $request->location_address,
        //     'start_date' => $request->start_date
        // ]);

        return redirect()->route('liquijobs.index')->with('message', 'Job Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Liquijob $liquijob)
    {
        //dd($liquijob['id']);
        // fetch assets
        //$job_assets = DB::table('liquiassets')->where('id', $liquijob->id)->first();

        $job_assets = Liquiasset::query()
            ->select(['job_asset', 'job_id'])
            ->where('job_id', $liquijob['id'])
            ->orderBy('created_at', 'DESC')
            ->limit(10)->get();
        //dd($job_assets);
        //dd($job_assets);
        //

        return Inertia::render('Liquijobs/View',
            [
                'liquijobs' => $liquijob,
                'job_assets' => $job_assets
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
