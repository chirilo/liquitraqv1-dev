<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Liquiasset;
use App\Models\Liquijob;

use Illuminate\Support\Facades\Auth;

class AlljobsController extends Controller
{
    //
    
    public function index(Request $request)
    {

        // Get the currently authenticated user...
        $user = Auth::user(); 
        // Get the currently authenticated user's ID...
        $id = Auth::id();


        //$results = \DB::table('liquijobs')
                    // ->groupBy('liquijobs.id')
                    // ->limit('20')
                    // ->get();
                    
        // get current date and time
        $currentdatetime = now()->format('M d, Y - h:m A');
        
        $keyword = isset($_GET['key']) ? $_GET['key'] : 'jobs';
        $escaped_str = str_replace("%", "", $keyword);
        $keyword = $escaped_str;
        $keyword = mb_convert_encoding($keyword, 'UTF-8', 'UTF-8');
        //dd($keyword);
        //$results = Liquijob::whereLike(['company_name', 'corporate_address', 'contact_name', 'contact_email'], $keyword)->get();
        if( $keyword === "status" ){
            //
            //dd($keyword);
            $results = Liquijob::where('company_name', 'LIKE', "%{$keyword}%" )
                    ->orWhere('id', $keyword)
                    ->orWhere('status', 'workinprogress')
                    ->orWhere('status', 'completed')
                    ->orWhere('status', 'originalstate')
                    ->orWhere('contact_name', $keyword)
                    ->orWhere('contact_email', $keyword)
                    ->orWhere('location_address', $keyword)
                    ->get();
        }
        elseif( $keyword === 'sonumber' ){
            //$keyword = 9;
            //$results = Liquijob::where('id', $keyword)->get();
            // gets All latest jobs limit 100 

            if( $id == 5 || $user->email == 'webteamsupprt@gmail.com' ){
                // query all jobs since this is admin
                $results = Liquijob::orderBy('updated_at', 'DESC')->limit('10')->get();
            }
            else{
                // query all the current logged in users Jobs
                $results = Liquijob::where('job_owner_id', $id)->orderBy('updated_at', 'DESC')->limit('10')->get();
            }
            
        }
        else{
            if( $id == 5 || $user->email == 'webteamsupprt@gmail.com' ){
                // query all jobs since this is admin
                $results = Liquijob::where('company_name', 'LIKE', "%{$keyword}%" )
                    ->orWhere('id', $keyword)
                    ->orWhere('status', $keyword)
                    ->orWhere('corporate_address', $keyword)
                    ->orWhere('contact_name', $keyword)
                    ->orWhere('contact_email', $keyword)
                    ->orWhere('location_address', $keyword)
                    ->get();
            }
            else{
                //dd($keyword);
                // query all the current logged in users Jobs
                $results = Liquijob::where('job_owner_id', $id)
                    ->where('company_name', 'LIKE', "%{$keyword}%" )
                    ->orWhere('corporate_address', $keyword)
                    ->orWhere('contact_name', $keyword)
                    ->orWhere('contact_email', $keyword)
                    ->orWhere('location_address', $keyword)
                    ->get();
                //$results = Liquijob::where('job_owner_id', $id)->orderBy('updated_at', 'DESC')->limit('10')->get();
            }
            
        }
        
        //$results = Liquijob::all();

        //dd($results);
        //return Inertia::render('Liquijobs/Search');
        return Inertia::render('Liquijobs/Search', [
            'results' => $results,
            'keyword' => $keyword,
            'currentdatetime' => $currentdatetime,
        ]);
    }
}
