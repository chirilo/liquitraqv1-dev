<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Liquiasset;
use App\Models\Liquijob;

class AlljobsController extends Controller
{
    //
    public function index(Request $request)
    {
        $keyword = isset($_GET['key']) ? $_GET['key'] : 'jobs';
        $results = Liquijob::whereLike('company_name', $keyword)
                    ->whereLike('corporate_address', $keyword)
                    ->whereLike('contact_name', $keyword)
                    ->whereLike('contact_email', $keyword)
                    ->whereLike('location_address', $keyword)
                    ->get();
                    
        return Inertia::render('Liquijobs/Search', [
            'results' => $results,
            'keyword' => $keyword
        ]);
    }
}
