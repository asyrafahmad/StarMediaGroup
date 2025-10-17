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
          --text-muted: #2d2d2d;
          --sidebar-bg: #da2128;
          --sidebar-width: 240px;
      }

      body {
          margin: 0;
          font-family: "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
          font-size: 14px;
          color: var(--text-dark);
          background-color: var(--bg-light);
          display: flex;
          min-height: 100vh;
      }

      /* Sidebar */
      .sidebar {
          width: var(--sidebar-width);
          background-color: var(--sidebar-bg);
          color: #fff;
          display: flex;
          flex-direction: column;
          padding-top: 1.25rem;
          transition: left 0.3s ease;
      }

      .sidebar h2 {
          text-align: center;
          font-size: 1rem;
          letter-spacing: 0.5px;
          font-weight: 600;
          margin-bottom: 1rem;
          color: var(--brand-red);
      }

      .sidebar a {
          color: #ccc;
          text-decoration: none;
          display: block;
          padding: 0.6rem 1.25rem;
          border-left: 3px solid transparent;
          transition: all 0.2s ease;
      }

      .sidebar a:hover,
      .sidebar a.active {
          background-color: rgba(218,33,40,0.1);
          color: #fff;
          border-left: 3px solid var(--brand-red);
      }

      /* Header */
      header {
          background-color: #fff;
          border-bottom: 1px solid #e5e5e5;
          padding: 0.75rem 1.5rem;
          display: flex;
          justify-content: space-between;
          align-items: center;
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
      .main-content {
          flex: 1;
          display: flex;
          flex-direction: column;
      }

      .content {
          flex: 1;
          padding: 1.25rem 1.75rem;
          background-color: var(--bg-light);
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
      }

      /* Toggle for mobile */
      .toggle-btn {
          display: none;
          cursor: pointer;
          font-size: 1.3rem;
          margin-right: 1rem;
          color: var(--brand-red);
      }

      @media (max-width: 768px) {
          .sidebar {
              position: fixed;
              top: 0;
              left: -240px;
              height: 100%;
              z-index: 1000;
          }
          .sidebar.active {
              left: 0;
          }
          .toggle-btn {
              display: inline-block;
          }
      }
  </style>

</head>
<body>
  <aside class="sidebar" id="sidebar">
      <h2>Admin Panel</h2>
      <a href="{{ route('admin') }}" class="{{ request()->routeIs('admin') ? 'active' : '' }}">Dashboard</a>
      {{-- <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">Users</a>
      <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">Settings</a> --}}
      <a href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
         Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
          @csrf
      </form>
  </aside>

  <div class="main-content">
      <header>
          <div>
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
          sidebar.classList.toggle('active');
      }
  </script>

  @stack('scripts')
</body>
</html>
