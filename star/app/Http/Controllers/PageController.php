<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consent;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $cookie = $request->cookie('user_consent');
        $decoded = json_decode($cookie);

        if (isset($decoded->guid) || !empty($decoded->guid)) {
            $consent_value = Consent::where('guid', $decoded->guid)->first();

            $consent = [
                'guid' => $consent_value ? $consent_value->guid : null,
                'accepted_at' => $consent_value ? $consent_value->accepted_at : null,
                'declined_at' => $consent_value ? $consent_value->declined_at : null,
                'version' => $consent_value ? $consent_value->version : null,
                'ip_address' => $consent_value ? $consent_value->ip_address : null,
                'user_agent' => $consent_value ? $consent_value->user_agent : null,
            ];

            return view('pages.home ', ['consent' => $consent]);
        }
        else{

            $consent = [
                'guid' => null,
                'accepted_at' => null,
                'declined_at' =>  null,
                'version' =>  null,
                'ip_address' => null,
                'user_agent' =>  null,
            ];

            return view('pages.home ', ['consent' =>$consent]);
        }

    }

    public function about(Request $request)
    {
        $cookie = $request->cookie('user_consent');
        $decoded = json_decode($cookie);

        if (isset($decoded->guid) || !empty($decoded->guid)) {
            $consent_value = Consent::where('guid', $decoded->guid)->first();

            $consent = [
                'guid' => $consent_value ? $consent_value->guid : null,
                'accepted_at' => $consent_value ? $consent_value->accepted_at : null,
                'declined_at' => $consent_value ? $consent_value->declined_at : null,
                'version' => $consent_value ? $consent_value->version : null,
                'ip_address' => $consent_value ? $consent_value->ip_address : null,
                'user_agent' => $consent_value ? $consent_value->user_agent : null,
            ];

            return view('pages.about ', ['consent' => $consent]);
        }
        else{

            $consent = [
                'guid' => null,
                'accepted_at' => null,
                'declined_at' =>  null,
                'version' =>  null,
                'ip_address' => null,
                'user_agent' =>  null,
            ];

            return view('pages.about ', ['consent' =>$consent]);
        }
    }

    public function privacy(Request $request)
    {
        $cookie = $request->cookie('user_consent');
        $decoded = json_decode($cookie);

        return view('pages.privacy', ['consent' => $decoded]);

        if (isset($decoded->guid) || !empty($decoded->guid)) {
            $consent_value = Consent::where('guid', $decoded->guid)->first();

            $consent = [
                'guid' => $consent_value ? $consent_value->guid : null,
                'accepted_at' => $consent_value ? $consent_value->accepted_at : null,
                'declined_at' => $consent_value ? $consent_value->declined_at : null,
                'version' => $consent_value ? $consent_value->version : null,
                'ip_address' => $consent_value ? $consent_value->ip_address : null,
                'user_agent' => $consent_value ? $consent_value->user_agent : null,
            ];

            return view('pages.privacy ', ['consent' => $consent]);
        }
        else{

            $consent = [
                'guid' => null,
                'accepted_at' => null,
                'declined_at' =>  null,
                'version' =>  null,
                'ip_address' => null,
                'user_agent' =>  null,
            ];

            return view('pages.privacy ', ['consent' =>$consent]);
        }
    }

    public function terms(Request $request)
    {
        $cookie = $request->cookie('user_consent');
        $decoded = json_decode($cookie);

        if (isset($decoded->guid) || !empty($decoded->guid)) {
            $consent_value = Consent::where('guid', $decoded->guid)->first();

            $consent = [
                'guid' => $consent_value ? $consent_value->guid : null,
                'accepted_at' => $consent_value ? $consent_value->accepted_at : null,
                'declined_at' => $consent_value ? $consent_value->declined_at : null,
                'version' => $consent_value ? $consent_value->version : null,
                'ip_address' => $consent_value ? $consent_value->ip_address : null,
                'user_agent' => $consent_value ? $consent_value->user_agent : null,
            ];

            return view('pages.terms ', ['consent' => $consent]);
        }
        else{

            $consent = [
                'guid' => null,
                'accepted_at' => null,
                'declined_at' =>  null,
                'version' =>  null,
                'ip_address' => null,
                'user_agent' =>  null,
            ];

            return view('pages.terms ', ['consent' =>$consent]);
        }
    }

    public function login(Request $request)
    {
        $cookie = $request->cookie('user_consent');
        $decoded = json_decode($cookie);

        if (isset($decoded->guid) || !empty($decoded->guid)) {
            $consent_value = Consent::where('guid', $decoded->guid)->first();

            $consent = [
                'guid' => $consent_value ? $consent_value->guid : null,
                'accepted_at' => $consent_value ? $consent_value->accepted_at : null,
                'declined_at' => $consent_value ? $consent_value->declined_at : null,
                'version' => $consent_value ? $consent_value->version : null,
                'ip_address' => $consent_value ? $consent_value->ip_address : null,
                'user_agent' => $consent_value ? $consent_value->user_agent : null,
            ];

            return view('pages.login ', ['consent' => $consent]);
        }
        else{

            $consent = [
                'guid' => null,
                'accepted_at' => null,
                'declined_at' =>  null,
                'version' =>  null,
                'ip_address' => null,
                'user_agent' =>  null,
            ];

            return view('pages.login ', ['consent' =>$consent]);
        }
    }

    // Show registration form
    public function register(Request $request)
    {
        $cookie = $request->cookie('user_consent');
        $decoded = json_decode($cookie);

        if (isset($decoded->guid) || !empty($decoded->guid)) {
            $consent_value = Consent::where('guid', $decoded->guid)->first();

            $consent = [
                'guid' => $consent_value ? $consent_value->guid : null,
                'accepted_at' => $consent_value ? $consent_value->accepted_at : null,
                'declined_at' => $consent_value ? $consent_value->declined_at : null,
                'version' => $consent_value ? $consent_value->version : null,
                'ip_address' => $consent_value ? $consent_value->ip_address : null,
                'user_agent' => $consent_value ? $consent_value->user_agent : null,
            ];

            return view('pages.register ', ['consent' => $consent]);
        }
        else{

            $consent = [
                'guid' => null,
                'accepted_at' => null,
                'declined_at' =>  null,
                'version' =>  null,
                'ip_address' => null,
                'user_agent' =>  null,
            ];

            return view('pages.register ', ['consent' =>$consent]);
        }
    }
}
