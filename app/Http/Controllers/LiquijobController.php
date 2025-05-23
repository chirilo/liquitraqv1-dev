<?php

namespace App\Http\Controllers;

// use App\Models\Liquijob;
// use Illuminate\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Liquijob;
use App\Models\Liquiasset;

use Illuminate\Support\Facades\Auth;

class LiquijobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        // Get the currently authenticated user...
        $user = Auth::user(); 
        // Get the currently authenticated user's ID...
        $id = Auth::id();

        // this has count of assets per job
        // $liquijobs = \DB::table('liquijobs')
        // ->join('liquiassets', 'liquijobs.id', '=', 'liquiassets.job_id')
        // ->select('liquijobs.*', \DB::raw("count(liquiassets.job_id) as count"))
        // ->groupBy('liquijobs.id')
        // ->get();

        // get current date and time
        $currentdatetime = now()->format('M d, Y - H:i:s');

        /**
         * check here if user is Admin or Regular, if Admin query all jobs, if Regular, only query jobs created by Regular user
         */
        if( $id == 5 || $user->email == 'webteamsupprt@gmail.com' ){
            // query all jobs
            $liquijobs = \DB::table('liquijobs')
            ->groupBy('liquijobs.id')
            ->limit('10')->get();
        }
        else{
            $liquijobs = \DB::table('liquijobs')
            ->groupBy('liquijobs.id')
            ->where('job_owner_id', $id)
            ->limit('10')->get();
        }

        

        //dd($liquijobs);

        // $liquijobs = Liquijob::query()
        //     ->orderBy('created_at', 'DESC')
        //     ->filter($request->only('filter'))
        //     ->paginate(10)
        //     ->withQueryString();



        //dd($currentdatetime);

        //dd($user->email);

        $showeditdelete = 'normal';
        if( $id == 5 || $user->email == 'webteamsupprt@gmail.com' ){
            $showeditdelete = 'admin';
        }
        
        //dd($showeditdelete);exit;
        return Inertia::render('Liquijobs/Index', [
            'liquijobs' => $liquijobs,
            'filters' => $request->all('filter'),
            'message' => session('message'),
            'showeditdelete' => $showeditdelete,
            'currentdatetime' => $currentdatetime,
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
        else{
            $caddress = '';
            $cemail = '';
            $cname = '';
            $coname = '';
            $loaddress = '';
            $sdate = '';
        }

        // $server_data = json_encode([
        //     'caddress' => $caddress,
        //     'cemail' => $cemail,
        //     'cname' => $cname,
        //     'coname' => $coname,
        //     'loaddress' => $loaddress,
        //     'sdate' => $sdate,
        // ]);
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
                'sdate' => $sdate
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

        // Get the currently authenticated user...
        $user = Auth::user(); 
        // Get the currently authenticated user's ID...
        $id = Auth::id();

        Liquijob::create([
            'company_name' => $request->company_name,
            'corporate_address' => $request->corporate_address,
            'contact_name' => $request->contact_name,
            'contact_telephone' => $request->contact_telephone,
            'contact_email' => $request->contact_email,
            'location_address' => $request->location_address,
            'start_date' => $request->start_date,
            'type' => $request->type,
            'job_owner_id' => $id,

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
            ->select(['id','job_asset', 'job_id', 'asset_category', 'asset_status'])
            ->where('job_id', $liquijob['id'])
            ->orderBy('created_at', 'DESC')
            ->limit(10)->get();
        //dd($job_assets);
        //dd($job_assets);
        //

        $furniturejobassets = Liquiasset::query()
            ->select(['id','job_asset', 'job_id'])
            ->where('job_id', $liquijob['id'])
            ->where('asset_category', 'furniture')
            ->orderBy('created_at', 'DESC')
            ->get();
        $itjobassets = Liquiasset::query()
            ->select(['id','job_asset', 'job_id'])
            ->where('job_id', $liquijob['id'])
            ->where('asset_category', 'it')
            ->orderBy('created_at', 'DESC')
            ->get();
        $infrastructurejobassets = Liquiasset::query()
            ->select(['id','job_asset', 'job_id'])
            ->where('job_id', $liquijob['id'])
            ->where('asset_category', 'infrastructure')
            ->orderBy('created_at', 'DESC')
            ->get();

        $all = isset( $_GET['all'] ) ? $_GET['all'] : '';

        if ( $all ){
            //dd($job_assets);
            $jobassetscount = count($job_assets); // total number of assets
            $itjobassets = count($itjobassets);
            $infrastructurejobassets = count($infrastructurejobassets);
            $furniturejobassets = count($furniturejobassets);
            return Inertia::render('Liquijobs/All',
                [
                    'liquijobs' => $liquijob,
                    'liquijobid' => $liquijob['id'],
                    'job_assets' => $job_assets,
                    'jobassetscount' => $jobassetscount,
                    'itjobassets' => $itjobassets,
                    'infrastructurejobassets' => $infrastructurejobassets,
                    'furniturejobassets' => $furniturejobassets,
                ]
            );
        }else{
            $jobassetscount = count($job_assets); // total number of assets
            $itjobassets = count($itjobassets);
            $infrastructurejobassets = count($infrastructurejobassets);
            $furniturejobassets = count($furniturejobassets);
            return Inertia::render('Liquijobs/View',
                [
                    'liquijobs' => $liquijob,
                    'job_assets' => $job_assets,
                    'jobassetscount' => $jobassetscount,
                    'itjobassets' => $itjobassets,
                    'infrastructurejobassets' => $infrastructurejobassets,
                    'furniturejobassets' => $furniturejobassets,
                ]
            );
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Liquijob $liquijob)
    {
        //
        //dd($liquijob);exit();

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
        //dd($liquijob);
        // dd($request);
        // exit();

        // $request->validate([
        //     'heading' => 'required|string|max:255',
        //     'slug' => 'required||unique:liquijobs,slug,'.$blog->id.',id|string|max:255'
        // ]);
        // $liquijob->update([
        //     'heading' => $request->heading,
        //     'slug' => Str::slug($request->slug),
        //     'description' => $request->description
        // ]);

        $liquijob->update([
            'company_name' => $request->company_name,
            'corporate_address' => $request->corporate_address,
            'contact_name' => $request->contact_name,
            'contact_telephone' => $request->contact_telephone,
            'contact_email' => $request->contact_email,
            'location_address' => $request->location_address,
            'start_date' => $request->start_date,
            'type' => $request->type,
        ]);

        return redirect()->route('liquijobs.index')->with('message', 'Liquijob Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Liquijob $liquijob)
    {
        //
        $liquijob->delete();
        return redirect()->route('liquijobs.index')->with('message', 'Liquijob Deleted Successfully');
    }

    /**
     * Search and Filter feature
     */
    public function searchanything(Request $request)
    {

        // $liquijobs = \DB::table('liquijobs')
        //     //->where('liquijobs.name')
        //     ->groupBy('liquijobs.id')
        //     ->limit('20')
        //     ->get();

        // return Inertia::render('Liquijobs/Search', [
        //     'liquijobs' => $liquijobs,
        //     // 'filters' => $request->all('filter'),
        //     // 'message' => session('message'),
        // ]);
        return Inertia::render('Liquijobs/Search');
    }
}
