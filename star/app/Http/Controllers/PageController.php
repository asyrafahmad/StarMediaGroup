<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consent;

class PageController extends Controller
{
    /**
     * Retrieve consent data from the cookie.
     */
    private function getConsentData(Request $request): array
    {
        $cookie = $request->cookie('user_consent');
        $decoded = json_decode($cookie);

        // Default consent structure
        $default = [
            'guid' => null,
            'accepted_at' => null,
            'declined_at' => null,
            'version' => null,
            'ip_address' => null,
            'user_agent' => null,
        ];

        if (empty($decoded?->guid)) {
            return $default;
        }

        $consent = Consent::where('guid', $decoded->guid)->first();

        if (!$consent) {
            return $default;
        }

        return [
            'guid' => $consent->guid,
            'accepted_at' => $consent->accepted_at,
            'declined_at' => $consent->declined_at,
            'version' => $consent->version,
            'ip_address' => $consent->ip_address,
            'user_agent' => $consent->user_agent,
        ];
    }

    /**
     * Generic page render helper
     */
    private function renderPage(Request $request, string $view)
    {
        $consent = $this->getConsentData($request);
        return view("pages.$view", compact('consent'));
    }

    public function index(Request $request)
    {
        return $this->renderPage($request, 'home');
    }

    public function about(Request $request)
    {
        return $this->renderPage($request, 'about');
    }

    public function privacy(Request $request)
    {
        return $this->renderPage($request, 'privacy');
    }

    public function terms(Request $request)
    {
        return $this->renderPage($request, 'terms');
    }

    public function login(Request $request)
    {
        return $this->renderPage($request, 'login');
    }

    public function register(Request $request)
    {
        return $this->renderPage($request, 'register');
    }
}
