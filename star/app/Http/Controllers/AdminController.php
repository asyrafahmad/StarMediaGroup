<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consent;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Get consent records from the database ordered by most recent
        $all_consent = Consent::orderBy('id', 'desc')->get();

        return view('admin.consents', ['consents' => $all_consent]);
    }
}
