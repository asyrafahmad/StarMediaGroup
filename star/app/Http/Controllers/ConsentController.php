<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Consent;
use Carbon\Carbon;

class ConsentController extends Controller
{

    public function accept(Request $request)
    {
        // Generate GUID
        $guid = (string) Str::uuid();
        $now = Carbon::now();

        // Store consent in the database
        $consent = Consent::create([
            'guid' => $guid,
            'accepted_at' => $now,
            'version' => '1.0', // You can manage versions as needed
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        // Create cookie payload
        $payload = json_encode([
            'guid' => $guid,
            'accepted_at' => $now->toIso8601String(),
            'version' => '1.0',
        ]);

        // Set Cookie for 1 year
        $cookie = cookie('user_consent', $payload, 60 * 24 * 365, null, null, false, true);

        return response()->json(['status' => 'Consent accepted'])->cookie($cookie);
    }

    public function decline(Request $request)
    {
        $now = Carbon::now();

        // Store decline in the database
        $consent = Consent::create([
            'guid' => (string) Str::uuid(),
            'declined_at' => $now,
            'version' => '1.0',
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        // Create cookie payload
        $payload = json_encode([
            'guid' => '',
            'declined_at' => $now->toIso8601String(),
            'version' => '1.0',
        ]);

        // Set Cookie for 1 day

        /*
            path = null
            domain = null
            secure = false
            httpOnly = true
        */
        $cookie = cookie('user_consent_decline', $payload, 60 * 24, null, null, false, true);

        return response()->json(['message' => 'Consent declined'])->cookie($cookie);
    }
}
