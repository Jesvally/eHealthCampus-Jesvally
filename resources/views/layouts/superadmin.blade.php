<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — Super Admin Panel</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg:        #f0f4f8;
            --sidebar:   #1a0a2e;
            --sidebar-hover: #2d1554;
            --primary:   #7c3aed;
            --green:     #22c55e;
            --blue:      #3b82f6;
            --orange:    #f97316;
            --red:       #ef4444;
            --yellow:    #eab308;
            --text:      #1e293b;
            --muted:     #64748b;
            --white:     #ffffff;
            --border:    #e2e8f0;
            --card:      #ffffff;
            --radius:    12px;
        }

        body { font-family: 'Segoe UI', sans-serif; background: var(--bg); color: var(--text); display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar { width: 240px; background: var(--sidebar); min-height: 100vh; display: flex; flex-direction: column; position: fixed; top: 0; left: 0; bottom: 0; z-index: 100; }
        .sidebar-brand { padding: 24px 20px; border-bottom: 1px solid #2d1554; }
        .sidebar-brand .brand-title { color: #fff; font-size: 16px; font-weight: 700; }
        .sidebar-brand .brand-role  { color: #a78bfa; font-size: 11px; margin-top: 2px; text-transform: uppercase; letter-spacing: 1px; }
        .sidebar-brand .brand-crown { font-size: 22px; display: block; margin-bottom: 6px; }
        .sidebar-nav { flex: 1; padding: 16px 0; }
        .nav-section { padding: 8px 20px 4px; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; color: #6d28d9; font-weight: 700; }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 11px 20px; color: #a78bfa; text-decoration: none; font-size: 14px; transition: all .2s; }
        .nav-item:hover, .nav-item.active { background: var(--sidebar-hover); color: #fff; }
        .nav-item .nav-icon { font-size: 16px; width: 20px; text-align: center; }
        .sidebar-footer { padding: 16px 20px; border-top: 1px solid #2d1554; }
        .user-info { color: #a78bfa; font-size: 13px; margin-bottom: 10px; }
        .user-info strong { color: #fff; display: block; font-size: 14px; }
        .user-info .crown { font-size: 11px; background: #7c3aed; color: #fff; padding: 2px 8px; border-radius: 20px; display: inline-block; margin-top: 4px; }
        .btn-logout { width: 100%; padding: 9px; background: #ef4444; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-size: 13px; font-weight: 600; }
        .btn-logout:hover { background: #dc2626; }

        /* MAIN */
        .main { margin-left: 240px; flex: 1; padding: 28px; }

        /* PAGE HEADER */
        .page-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; }
        .page-title { font-size: 24px; font-weight: 700; color: var(--text); }
        .page-subtitle { font-size: 14px; color: var(--muted); margin-top: 4px; }
        .header-date { font-size: 13px; color: var(--muted); background: var(--white); padding: 8px 14px; border-radius: 8px; border: 1px solid var(--border); }

        /* STATS GRID */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: var(--white); border-radius: var(--radius); padding: 20px; display: flex; align-items: center; gap: 16px; box-shadow: 0 1px 3px rgba(0,0,0,.06); border-left: 4px solid transparent; }
        .stat-blue   { border-color: var(--blue); }
        .stat-green  { border-color: var(--green); }
        .stat-purple { border-color: var(--primary); }
        .stat-orange { border-color: var(--orange); }
        .stat-icon   { font-size: 28px; }
        .stat-number { font-size: 28px; font-weight: 800; color: var(--text); line-height: 1; }
        .stat-label  { font-size: 13px; color: var(--muted); margin-top: 4px; }

        /* CARD */
        .card { background: var(--white); border-radius: var(--radius); box-shadow: 0 1px 3px rgba(0,0,0,.06); margin-bottom: 24px; overflow: hidden; }
        .card-header { display: flex; justify-content: space-between; align-items: center; padding: 18px 20px; border-bottom: 1px solid var(--border); }
        .card-title  { font-size: 16px; font-weight: 700; }
        .btn-link    { color: var(--primary); text-decoration: none; font-size: 13px; font-weight: 600; }
        .btn-link:hover { text-decoration: underline; }
        .cards-row   { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .card-half   { margin-bottom: 0; padding: 20px; }

        /* TABLE */
        .table-wrap  { overflow-x: auto; }
        .table       { width: 100%; border-collapse: collapse; font-size: 14px; }
        .table th    { text-align: left; padding: 12px 16px; background: #f8fafc; color: var(--muted); font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; border-bottom: 1px solid var(--border); }
        .table td    { padding: 13px 16px; border-bottom: 1px solid var(--border); vertical-align: middle; }
        .table tr:last-child td { border-bottom: none; }
        .table tbody tr:hover { background: #faf5ff; }
        .empty-state { text-align: center; color: var(--muted); padding: 32px !important; }

        /* BADGES */
        .badge-nim      { background: #ede9fe; color: #5b21b6; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; font-family: monospace; }
        .duration-badge { background: #f0fdf4; color: #15803d; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; }
        .status-badge   { padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; }
        .status-normal  { background: #dcfce7; color: #15803d; }
        .status-rendah, .status-kurang { background: #fef9c3; color: #854d0e; }
        .status-tinggi  { background: #fee2e2; color: #991b1b; }
        .role-badge       { padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; }
        .role-user        { background: #e0f2fe; color: #0369a1; }
        .role-admin       { background: #fef9c3; color: #854d0e; }
        .role-super_admin { background: #f3e8ff; color: #7e22ce; }

        /* BUTTONS */
        .action-group { display: flex; gap: 6px; flex-wrap: wrap; align-items: center; }
        .btn         { padding: 6px 12px; border-radius: 6px; border: none; cursor: pointer; font-size: 12px; font-weight: 600; transition: opacity .2s; }
        .btn:hover   { opacity: .85; }
        .btn-sm      { padding: 5px 10px; font-size: 12px; }
        .btn-danger  { background: #fee2e2; color: #991b1b; }
        .btn-warning { background: #fef9c3; color: #854d0e; }
        .select-role { padding: 5px 8px; border-radius: 6px; border: 1px solid var(--border); font-size: 12px; background: #f8fafc; cursor: pointer; }

        /* ALERTS */
        .alert         { padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; font-weight: 500; }
        .alert-success { background: #dcfce7; color: #15803d; border: 1px solid #86efac; }
        .alert-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

        /* PAGINATION */
        .pagination-wrap { padding: 16px 20px; border-top: 1px solid var(--border); }

        /* QUICK LINKS */
        .quick-links-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 12px; margin-bottom: 24px; }
        .quick-link-card  { background: var(--white); border: 1px solid var(--border); border-radius: var(--radius); padding: 16px; display: flex; align-items: center; gap: 10px; text-decoration: none; color: var(--text); transition: all .2s; }
        .quick-link-card:hover { border-color: var(--primary); box-shadow: 0 0 0 3px #ede9fe; }
        .ql-icon  { font-size: 22px; }
        .ql-label { flex: 1; font-size: 13px; font-weight: 600; }
        .ql-arrow { color: var(--muted); font-size: 16px; }

        /* BAR CHART */
        .bar-chart  { display: flex; flex-direction: column; gap: 10px; margin-top: 12px; }
        .bar-item   { display: flex; align-items: center; gap: 10px; }
        .bar-label  { width: 32px; font-size: 12px; color: var(--muted); text-align: right; }
        .bar-wrap   { flex: 1; background: #f1f5f9; border-radius: 6px; height: 24px; overflow: hidden; }
        .bar-fill   { height: 100%; background: var(--primary); border-radius: 6px; display: flex; align-items: center; justify-content: flex-end; padding-right: 8px; min-width: 32px; transition: width .5s ease; }
        .bar-value  { font-size: 11px; font-weight: 700; color: #fff; }

        /* BIG STAT */
        .big-stat   { text-align: center; padding: 24px 0 12px; }
        .big-number { display: block; font-size: 48px; font-weight: 800; color: var(--text); }
        .big-label  { display: block; font-size: 14px; color: var(--muted); margin-top: 6px; }
        .sleep-note { text-align: center; padding-bottom: 8px; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">
        <span class="brand-crown">👑</span>
        <div class="brand-title">HealthApp</div>
        <div class="brand-role">Super Admin Panel</div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section">Overview</div>
        <a href="{{ route('superadmin.dashboard') }}" class="nav-item {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">🏠</span> Dashboard
        </a>
        <a href="{{ route('superadmin.statistics') }}" class="nav-item {{ request()->routeIs('superadmin.statistics') ? 'active' : '' }}">
            <span class="nav-icon">📊</span> Statistik
        </a>

        <div class="nav-section">Manajemen</div>
        <a href="{{ route('superadmin.users') }}" class="nav-item {{ request()->routeIs('superadmin.users') ? 'active' : '' }}">
            <span class="nav-icon">👥</span> Mahasiswa
        </a>
        <a href="{{ route('superadmin.admins') }}" class="nav-item {{ request()->routeIs('superadmin.admins') ? 'active' : '' }}">
            <span class="nav-icon">🛡️</span> Admin
        </a>

        <div class="nav-section">Data Kesehatan</div>
        <a href="{{ route('superadmin.health-records') }}" class="nav-item {{ request()->routeIs('superadmin.health-records') ? 'active' : '' }}">
            <span class="nav-icon">🩺</span> Rekam Medis
        </a>
        <a href="{{ route('superadmin.sleep-records') }}" class="nav-item {{ request()->routeIs('superadmin.sleep-records') ? 'active' : '' }}">
            <span class="nav-icon">😴</span> Data Tidur
        </a>
    </nav>
    <div class="sidebar-footer">
        <div class="user-info">
            <strong>{{ auth()->user()->name }}</strong>
            {{ auth()->user()->nim }}
            <span class="crown">👑 Super Admin</span>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</aside>

<main class="main">
    @yield('content')
</main>

</body>
</html>
