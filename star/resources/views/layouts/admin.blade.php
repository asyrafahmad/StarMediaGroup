<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
  <aside class="sidebar" id="sidebar">
      <h2>Admin Panel</h2>
      <a href="{{ route('admin') }}" class="{{ request()->routeIs('admin') ? 'active' : '' }}">Dashboard</a>
      {{-- Example extra links --}}
      {{-- <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">Users</a>
      <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">Settings</a> --}}
      <a href="{{ route('logout') }}">Logout</a>
  </aside>

  <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

  <div class="main-content">
      <header>
          <div style="display:flex;align-items:center;">
              <span class="toggle-btn" onclick="toggleSidebar()">☰</span>
              <h1>@yield('page_title', 'Dashboard')</h1>
          </div>
          <div class="user-info">
              Logged in as: <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>
          </div>
      </header>

      <main class="content">
          @yield('content')
      </main>

      <footer>
          © 2025 Star Media Group Berhad. All rights reserved.
      </footer>
  </div>

  <script>
      function toggleSidebar() {
          const sidebar = document.getElementById('sidebar');
          const overlay = document.getElementById('overlay');
          sidebar.classList.toggle('active');
          overlay.classList.toggle('active');
      }
  </script>

  @stack('scripts')
</body>
</html>
