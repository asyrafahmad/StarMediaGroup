<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My Site')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>
<body>
  <nav>
    <div class="container">
      <div style="display:flex;align-items:center;gap:1rem;flex-wrap:wrap;justify-content:center;">
        <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:8px;">
          <img src="{{ asset('images/star-logo.png') }}" alt="Star Media Group Logo">
        </a>
      </div>

      <div class="nav-links">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('privacy') }}">Privacy</a>
        <a href="{{ route('terms') }}">Terms</a>
      </div>

      <div class="auth-links">
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
      </div>
    </div>
  </nav>

  <main class="container" id="app">
    @yield('content')
  </main>

  <footer>
    © 2025 Star Media Group Berhad. All rights reserved.
  </footer>

  {{-- Consent overlay markup --}}
  <div id="consent-overlay" class="consent-overlay" style="display:none;">
    <div class="consent-box" role="dialog" aria-modal="true" aria-labelledby="consent-title">
      <h3 id="consent-title">Privacy & Cookies</h3>
      <p>
        Cookies are necessary for this website to function properly, for performance measurement,
        and to provide you with the best experience.
      </p>
      <p>
        By continuing to access or use this site, you acknowledge and consent to our use of cookies
        in accordance with our
        <a href="{{ route('terms') }}" target="_self">[Terms &amp; Conditions]</a>
        and
        <a href="{{ route('privacy') }}" target="_self">[Privacy Statement]</a>.
      </p>
      <div id="consent-button" class="consent-actions"
           @if(!in_array(Route::currentRouteName(), ['terms', 'privacy']))
               style="display:none;"
           @endif>
        <button id="decline-consent" class="btn ghost">Decline</button>
        <button id="accept-consent" class="btn primary">Accept</button>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const path = window.location.pathname;
        const consentButton = document.getElementById('consent-button');

        if (path === '/terms' || path === '/privacy') {
            consentButton.style.display = 'flex';
        } else {
            consentButton.style.display = 'none';
        }

        const userConsent = @json($consent);
        const overlay = document.getElementById('consent-overlay');

        if (userConsent.guid !== null) {
            overlay.style.display = 'none';
            document.body.classList.remove('consent-active');
        } else {
            overlay.style.display = 'flex';
            document.body.classList.add('consent-active');
        }
    });


    document.body.classList.add('consent-active');
    const overlay = document.getElementById('consent-overlay');
    overlay.style.display = 'flex';

    document.getElementById('accept-consent').addEventListener('click', async function () {
        try {
            const res = await fetch('{{ route("consent.accept") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            });
            if (res.ok) {
                overlay.style.display = 'none';
                document.body.classList.remove('consent-active');
            }
        } catch (e) {
            console.error(e);
        }
    });

    document.getElementById('decline-consent').addEventListener('click', async function () {
        try {
            const res = await fetch('{{ route("consent.decline") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            });
            if (res.ok) {
                overlay.style.display = 'none';
                document.body.classList.remove('consent-active');
            }
        } catch (e) {
            console.error(e);
        }
    });
  </script>

  @stack('scripts')
</body>
</html>
