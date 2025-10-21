<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin Dashboard')</title>

  <style>
      :root {
          --brand-red: #2d2d2d;
          --text-dark: #2d2d2d;
          --text-muted: #666;
          --sidebar-bg: #da2128;
          --sidebar-width: 220px;
          --transition-speed: 0.3s;
      }

      body {
          margin: 0;
          font-family: "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
          font-size: 14px;
          color: var(--text-dark);
          display: flex;
          min-height: 100vh;
          background: #f7f7f7;
      }

      /* Sidebar */
      .sidebar {
          width: var(--sidebar-width);
          background-color: var(--sidebar-bg);
          color: #fff;
          display: flex;
          flex-direction: column;
          padding-top: 1.25rem;
          position: fixed;
          top: 0;
          left: 0;
          height: 100%;
          transition: transform var(--transition-speed) ease;
      }

      .sidebar h2 {
          text-align: center;
          font-size: 1.1rem;
          font-weight: 600;
          margin-bottom: 1rem;
          color: #fff;
      }

      .sidebar a {
          color: #ccc;
          text-decoration: none;
          display: block;
          padding: 0.7rem 1.25rem;
          border-left: 3px solid transparent;
          transition: all 0.2s ease;
      }

      .sidebar a:hover,
      .sidebar a.active {
          background-color: rgba(255,255,255,0.1);
          color: #fff;
          border-left: 3px solid var(--brand-red);
      }

      /* Main layout */
      .main-content {
          flex: 1;
          margin-left: var(--sidebar-width);
          display: flex;
          flex-direction: column;
          min-height: 100vh;
          transition: margin-left var(--transition-speed) ease;
      }

      /* Header */
      header {
          background-color: #fff;
          border-bottom: 1px solid #e5e5e5;
          padding: 0.75rem 1.5rem;
          display: flex;
          justify-content: space-between;
          align-items: center;
          position: sticky;
          top: 0;
          z-index: 100;
      }

      header h1 {
          font-size: 1rem;
          font-weight: 600;
          margin: 0;
          color: var(--brand-red);
      }

      .user-info {
          font-size: 0.85rem;
          color: var(--text-muted);
      }

      /* Content */
      .content {
          flex: 1;
          padding: 1.5rem;
          background-color: #f9f9f9;
      }

      .content h2 {
          font-size: 1.1rem;
          color: var(--brand-red);
          margin-top: 0;
      }

      /* Footer */
      footer {
          background-color: #fff;
          border-top: 1px solid #e5e5e5;
          text-align: center;
          padding: 0.75rem;
          font-size: 0.8rem;
          color: var(--text-muted);
          position: sticky;
          bottom: 0;
      }

      /* Toggle for mobile */
      .toggle-btn {
          display: none;
          cursor: pointer;
          font-size: 1.4rem;
          margin-right: 1rem;
          color: var(--brand-red);
          user-select: none;
      }

      /* Overlay (when sidebar open on mobile) */
      .overlay {
          position: fixed;
          inset: 0;
          background: rgba(0, 0, 0, 0.4);
          z-index: 999;
          display: none;
      }

      /* Responsive */
      @media (max-width: 768px) {
          .sidebar {
              transform: translateX(-100%);
              z-index: 1000;
              box-shadow: 2px 0 8px rgba(0,0,0,0.3);
          }
          .sidebar.active {
              transform: translateX(0);
          }
          .main-content {
              margin-left: 0;
          }
          .toggle-btn {
              display: inline-block;
          }
          .overlay.active {
              display: block;
          }
      }
  </style>
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
