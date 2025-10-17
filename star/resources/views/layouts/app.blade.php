<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'My Site')</title>

  <style>
        /* basic responsive container */
        body {
            margin:0;
            font-family:system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }

        .container {
            max-width:1000px;
            margin:0 auto;
            padding:1rem;
        }

        /* Consent modal styles */
        .consent-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .consent-box {
            width: calc(100% - 40px);
            max-width: 720px;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        }

        .consent-actions {
            display:flex;
            gap:8px;
            justify-content:flex-end;
            margin-top:12px; flex-wrap:wrap;
        }

        .btn {
            padding:8px 14px;
            border-radius:6px;
            border: none;
            cursor:pointer;
        }

        .btn.primary {
            background:#0b74de;
            color:#fff;
        }

        .btn.ghost {
            background:#f3f4f6;
            color:#111;
        }

        /* prevent scrolling when consent-active is on body (JS toggles) */
        body.consent-active {
            height:100vh; overflow:hidden; touch-action:none;
        }

        @media (max-width:600px) {
            .consent-box { padding:16px; font-size:14px; }
            .consent-actions { justify-content: center; }
        }

  </style>
  @stack('styles')
</head>
<body>
  <nav style="background:#0b74de;color:#fff;padding:.75rem;">
    <div class="container" style="display:flex;gap:1rem;align-items:center;">
      <a href="{{ route('home') }}" style="color:#fff;text-decoration:none;font-weight:600">MySite</a>
      <div style="margin-left:1rem;">
        <a href="{{ route('home') }}"  style="color:#fff;margin-right:12px;">Home</a>
        <a href="{{ route('about') }}" style="color:#fff;margin-right:12px;">About</a>
        <a href="{{ route('privacy') }}" style="color:#fff;margin-right:12px;">Privacy</a>
        <a href="{{ route('terms') }}" style="color:#fff;">Terms</a>
      </div>
    </div>
  </nav>

  <main class="container" id="app">
    @yield('content')
  </main>

  <footer style="text-align:center;padding:1rem;margin-top:2rem;color:#666;">
    © 2025 Star Media Group Berhad. All rights reserved.
  </footer>

  {{-- Consent overlay markup (initially hidden by CSS/JS) --}}
  <div id="consent-overlay" class="consent-overlay" style="display:none;">
    <div class="consent-box" role="dialog" aria-modal="true" aria-labelledby="consent-title">
        <h3 id="consent-title">Privacy & Cookies</h3>
        <p>
            Cookies are necessary for this website to function properly, for performance measurement,
            and to provide you with the best experience.
        </p>
        <p>
            By continuing to access or use this site, you acknowledge and consent to our use of cookies
            in accordance with our <a href="{{ route('terms') }}" target="_self">Terms &amp; Conditions</a>
            and <a href="{{ route('privacy') }}" target="_self">Privacy Statement</a>.
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

            if(userConsent.guid && userConsent.guid !== '') {
                overlay.style.display = 'none';
                document.body.classList.remove('consent-active');
            }else{
                overlay.style.display = 'flex';
                document.body.classList.add('consent-active');
}
    });

    // Helper: read cookie by name
    function readCookie(name) {
      const v = document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)');
      return v ? decodeURIComponent(v.pop()) : null;
    }

    // Show modal if neither accept cookie (site_consent) nor decline cookie (site_consent_decline) exists
    (function () {
      const consentCookie = readCookie('site_consent');
      const declineCookie = readCookie('site_consent_decline');

      // if no consent and no decline (or expired), show
      if (!consentCookie && !declineCookie) {
        document.body.classList.add('consent-active');
        const overlay = document.getElementById('consent-overlay');
        overlay.style.display = 'flex';

        // bind buttons
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
              // response sets cookie via Set-Cookie; but ensure cookie is present client-side too
              // hide overlay and restore scrolling
              overlay.style.display = 'none';
              document.body.classList.remove('consent-active');
            } else {
              console.error('Consent accept failed');
            }
          } catch (e) { console.error(e); }
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
            } else {
              console.error('Consent decline failed');
            }
          } catch (e) { console.error(e); }
        });

        // make sure tab focus is inside modal (basic)
        document.addEventListener('focus', function (ev) {
          if (document.body.classList.contains('consent-active')) {
            if (!overlay.contains(ev.target)) {
              ev.stopPropagation();
              overlay.querySelector('.consent-box').focus();
            }
          }
        }, true);
      }
    })();
  </script>

  @stack('scripts')
</body>
</html>
