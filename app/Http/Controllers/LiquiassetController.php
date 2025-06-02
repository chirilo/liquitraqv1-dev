<?php

namespace App\Http\Controllers;

// use App\Models\Liquiasset;
// use Illuminate\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Liquiasset;
use App\Models\Liquijob;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

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
        // get current date and time
        //$currentdatetime = now()->format('M d, Y - h:m A');
        $date_default_timezone_get = date_default_timezone_get();
        //dd($date_default_timezone_get);
        $currentdatetime = new \DateTime("now", new \DateTimeZone(''.$date_default_timezone_get.''));
        $currentdatetime = $currentdatetime->format('M d, Y h:i A');
        //$currentdatetime = date('M d, Y h:i:sA');
        //
        return Inertia::render(
            'Liquiassets/Index', [
                'currentdatetime' => $currentdatetime,
            ]
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

        //dd($request);
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
            'asset_disposition' => $request->asset_disposition,
            'assetdisdate' => $request->assetdisdate,
            'assetdiswho' => $request->assetdiswho,
            'assetdisticketshippinginfo' => $request->assetdisticketshippinginfo,

        ]);

        return redirect()->route('liquijobs.index')->with('message', 'Asset added successfully.');
        //return redirect()->to('/liquijobs/'.$request->jobid )->with('message', 'Asset Added Successfully');
        //return redirect()->route('liquijobs.show', $request->jobid)->with('message', 'Asset Added Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Liquiasset $liquiasset)
    {
        //

        // dd($liquiasset);
        // exit;

        // $currenturl = url()->current();
        // $exploded_url = explode('liquiassets', $currenturl);
        // $exploded_url = explode('/', $exploded_url[1]);
        
        // Get the currently authenticated user...
        $user = Auth::user(); 
        // Get the currently authenticated user's ID...
        $id = Auth::id();
        

        $job_assets = Liquiasset::query()
            ->select('*')
            ->where('id', $liquiasset['id'])
            ->get();

        $job_assets2 = Liquiasset::query()
            ->select('*')
            ->where('id', $liquiasset['id'])
            ->get()->toArray();

        $thisjob = Liquijob::query()->select('*')->where('id', $job_assets[0]['job_id'])->get()->toArray();
        $thisjobcompanyname = $thisjob[0]['company_name'];
        $thisjobid = $thisjob[0]['id'];

        // USER = 'admin' | 'owner' | 'employee'
        $userrole = 'normal';
        if( $user->email == 'webteamsupprt@gmail.com' ){
            $userrole = 'admin';
        }
        else if( $user->id == $thisjob[0]['job_owner_id'] ) {
            $userrole = 'owner' ;
        }
        else{
            $userrole = 'employee';
        }

        //dd($thisjob[0]['company_name']);
        //dd($job_assets);
        // get current date and time
        //$currentdatetime = now()->format('M d, Y - h:m A');
        $date_default_timezone_get = date_default_timezone_get();
        //dd($date_default_timezone_get);
        $currentdatetime = new \DateTime("now", new \DateTimeZone(''.$date_default_timezone_get.''));
        $currentdatetime = $currentdatetime->format('M d, Y h:i A');
        //$currentdatetime = date('M d, Y h:i:sA');

        return Inertia::render('Liquiassets/View',
            [
                'job_assets' => $job_assets,
                'currentdatetime' => $currentdatetime,
                'thisjobcompanyname' => $thisjobcompanyname,
                'thisjobid' => $thisjobid,
                'userrole' => $userrole,
            ]
        );


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Liquiasset $liquiasset)
    {
        //
        $job_assets = Liquiasset::query()
            ->select('*')
            ->where('id', $liquiasset['id'])
            ->get();
            
        $thisjob = Liquijob::query()->select('*')->where('id', $job_assets[0]['job_id'])->get()->toArray();
        $thisjobid = $thisjob[0]['id'];

        return Inertia::render(
            'Liquiassets/Edit',
            [
                'liquiasset' => $liquiasset,
                'thisjobid' => $thisjobid,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Liquiasset $liquiasset)
    {
        //

        // dd($request->file('job_asset_url'));
        // exit();

        // $image = $request->file('job_asset');
        // $fname = $request->file('job_asset')->getClientOriginalName();

        // $storagePath = Storage::disk('public')->put('job_assets', $image);
        // $storageName = basename($storagePath);


        $liquiasset->update([
            //'job_asset' => '/storage/job_assets/'.$storageName,
            //'job_id' => $request->jobid,
            'asset_category' => $request->asset_category,
            'asset_quantity' => $request->asset_quantity,
            'asset_type' => $request->asset_type,
            'asset_make' => $request->asset_make,
            'asset_model' => $request->asset_model,
            'asset_serial' => $request->asset_serial,
            'asset_weight_each' => $request->asset_weight_each,
            'asset_description' => $request->asset_description,
            'asset_status' => $request->asset_status,
            'asset_disposition' => $request->asset_disposition,
            'assetdisdate' => $request->assetdisdate,
            'assetdiswho' => $request->assetdiswho,
            'assetdisticketshippinginfo' => $request->assetdisticketshippinginfo,
        ]);

        return redirect()->route('liquijobs.index')->with('message', 'Asset added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Liquiasset $liquiasset)
    {
        //
        //
        $liquiasset->delete();
        return redirect()->route('liquijobs.index')->with('message', 'Job Asset deleted successfully.');
    }
}
