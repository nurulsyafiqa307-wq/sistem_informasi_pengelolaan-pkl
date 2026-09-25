<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Informasi Jurnal PKL') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* =========================================================
           THEME
           ========================================================= */
        :root {
            --bg-body: #f4f7fb;
            --bg-sidebar: #123b6d;
            --bg-card: #ffffff;
            --bg-card-alt: #f8fafc;
            --bg-hover: rgba(15, 61, 107, 0.06);
            --bg-input: #ffffff;

            --border: #dbe3ef;
            --border-active: #bfd0e5;

            --text-primary: #172033;
            --text-secondary: #475569;
            --text-muted: #64748b;
            --text-dim: #94a3b8;

            --accent-blue: #2563eb;
            --accent-purple: #7c3aed;
            --accent-pink: #db2777;
            --accent-green: #16a34a;
            --accent-amber: #d97706;
            --accent-red: #dc2626;

            --sidebar-w: 256px;
        }

        /* =========================================================
           BASIC
           ========================================================= */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: var(--bg-body);
            color: var(--text-primary);
            font-family: 'Figtree', system-ui, sans-serif;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 10%, rgba(37, 99, 235, 0.04) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 80%, rgba(124, 58, 237, 0.035) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        /* =========================================================
           SIDEBAR
           ========================================================= */
        .sidebar-bg {
            background: var(--bg-sidebar);
            border-right: 1px solid rgba(255, 255, 255, 0.10);
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 3px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 99px;
        }

        .nav-link {
            position: relative;
            transition: all 0.15s ease;
            color: #dbeafe;
            border-radius: 8px;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 6px;
            bottom: 6px;
            width: 3px;
            border-radius: 0 3px 3px 0;
            background: var(--accent-blue);
            transform: scaleY(0);
            transition: transform 0.2s ease;
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.14);
            color: #ffffff;
        }

        .nav-link.active::before {
            transform: scaleY(1);
        }

        .nav-link:hover:not(.active) {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
        }

        .sidebar-overlay {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
            background: rgba(15, 23, 42, 0.35);
            backdrop-filter: blur(4px);
        }

        .sidebar-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }

        .sidebar-panel {
            width: var(--sidebar-w);
            transform: translateX(-100%);
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-panel.open {
            transform: translateX(0);
        }

        /* =========================================================
           MAIN CONTENT
           ========================================================= */
        .main-content {
            margin-left: 0;
            width: 100%;
        }

        @media (min-width: 1024px) {
            .main-content {
                margin-left: var(--sidebar-w);
                width: calc(100% - var(--sidebar-w));
            }
            .sidebar-panel {
                transform: translateX(0);
                transition: none;
            }
        }

        body.sidebar-open {
            overflow: hidden;
        }

        @media (min-width: 1024px) {
            body.sidebar-open {
                overflow: auto;
            }
        }

        /* =========================================================
           TOPBAR
           ========================================================= */
        .topbar-bg {
            background: rgba(255, 255, 255, 0.96);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(20px);
            box-shadow: 0 1px 4px rgba(15, 23, 42, 0.04);
        }

        /* =========================================================
           CARD
           ========================================================= */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            transition: border-color 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.05);
        }

        .card:hover {
            border-color: var(--border-active);
            box-shadow: 0 5px 18px rgba(15, 23, 42, 0.07);
        }

        /* =========================================================
           INPUT
           ========================================================= */
        .input-dark {
            background: var(--bg-input);
            border: 1px solid var(--border);
            color: var(--text-primary);
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.02);
        }

        .input-dark:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        .input-dark::placeholder {
            color: #94a3b8;
        }

        select.input-dark option {
            background: #ffffff;
            color: var(--text-primary);
        }

        /* =========================================================
           STAT CARD
           ========================================================= */
        .stat-card {
            position: relative;
            overflow: hidden;
            border-radius: 14px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.05);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
        }

        .stat-card:hover {
            border-color: var(--border-active);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.10);
        }

        .stat-card:hover::after {
            opacity: 1;
        }

        .stat-card.blue::after {
            background: radial-gradient(circle, rgba(37, 99, 235, 0.08) 0%, transparent 70%);
        }

        .stat-card.purple::after {
            background: radial-gradient(circle, rgba(124, 58, 237, 0.08) 0%, transparent 70%);
        }

        .stat-card.amber::after {
            background: radial-gradient(circle, rgba(217, 119, 6, 0.08) 0%, transparent 70%);
        }

        .stat-card.green::after {
            background: radial-gradient(circle, rgba(22, 163, 74, 0.08) 0%, transparent 70%);
        }

        /* =========================================================
           STAT TREND
           ========================================================= */
        .stat-trend {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 6px;
            letter-spacing: 0.01em;
        }

        .stat-trend.up {
            background: #dcfce7;
            color: #166534;
        }

        .stat-trend.neutral {
            background: #f1f5f9;
            color: var(--text-muted);
        }

        /* =========================================================
           WELCOME BANNER
           ========================================================= */
        .welcome-banner {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            background: linear-gradient(135deg, #1e4f8f 0%, #3158a4 50%, #493b8f 100%);
        }

        .welcome-banner .glow-1 {
            position: absolute;
            width: 300px;
            height: 300px;
            top: -120px;
            right: -60px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
            filter: blur(60px);
            animation: glow-drift 8s ease-in-out infinite;
        }

        .welcome-banner .glow-2 {
            position: absolute;
            width: 200px;
            height: 200px;
            bottom: -80px;
            left: 20%;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            filter: blur(50px);
            animation: glow-drift 10s ease-in-out infinite reverse;
        }

        .welcome-banner .grid-pattern {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        @keyframes glow-drift {
            0%, 100% { transform: translate(0, 0); }
            33% { transform: translate(15px, -10px); }
            66% { transform: translate(-10px, 8px); }
        }

        /* =========================================================
           TABLE
           ========================================================= */
        .table-dark th {
            background: #f8fafc;
            color: #64748b;
            font-weight: 600;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            border-bottom: 1px solid var(--border);
        }

        .table-dark td {
            color: var(--text-secondary);
            font-size: 13px;
            border-bottom: 1px solid #edf2f7;
        }

        .table-dark tbody tr {
            transition: background 0.15s ease;
        }

        .table-dark tbody tr:hover td {
            background: #f8fafc;
        }

        /* =========================================================
           BADGES
           ========================================================= */
        .badge {
            font-size: 10px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 6px;
            letter-spacing: 0.02em;
            display: inline-block;
        }

        .badge-success { background: #dcfce7; color: #166534; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .badge-info { background: #dbeafe; color: #1e40af; }
        .badge-neutral { background: #f1f5f9; color: #64748b; }

        /* =========================================================
           BUTTONS
           ========================================================= */
        .btn-primary {
            background: var(--accent-blue);
            color: #fff;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.25);
        }

        .btn-primary:active { transform: translateY(0); }

        .btn-outline {
            background: #ffffff;
            color: var(--text-secondary);
            padding: 7px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-outline:hover {
            background: rgba(37, 99, 235, 0.06);
            border-color: var(--border-active);
            color: var(--accent-blue);
        }

        .btn-danger {
            background: #fee2e2;
            color: #b91c1c;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-danger:hover { background: #fecaca; }

        .btn-success {
            background: #dcfce7;
            color: #15803d;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-success:hover { background: #bbf7d0; }

        /* =========================================================
           ANIMATION & PULSE
           ========================================================= */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        .float-anim { animation: float 3.5s ease-in-out infinite; }

        @keyframes fade-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .anim { animation: fade-up 0.5s ease both; }
        .anim-d1 { animation-delay: 0.04s; }
        .anim-d2 { animation-delay: 0.08s; }
        .anim-d3 { animation-delay: 0.12s; }
        .anim-d4 { animation-delay: 0.16s; }
        .anim-d5 { animation-delay: 0.22s; }
        .anim-d6 { animation-delay: 0.28s; }
        .anim-d7 { animation-delay: 0.34s; }

        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 1; }
            100% { transform: scale(2.2); opacity: 0; }
        }
        .pulse-dot { position: relative; }
        .pulse-dot::after {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 9999px;
            background: var(--accent-red);
            animation: pulse-ring 1.5s cubic-bezier(0,0,0.2,1) infinite;
            z-index: -1;
        }

        /* =========================================================
           TEXT / UTILITY
           ========================================================= */
        .btn-ghost {
            color: var(--text-muted);
            transition: all 0.15s ease;
            border-radius: 8px;
            text-decoration: none;
        }
        .btn-ghost:hover {
            background: rgba(37, 99, 235, 0.06);
            color: var(--text-primary);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .mini-bar {
            height: 5px;
            border-radius: 99px;
            background: #e5edf6;
            overflow: hidden;
        }

        .mini-bar-fill {
            height: 100%;
            border-radius: 99px;
            transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        /* Custom Utility Classes */
        .gap-1 { gap: 4px; }
        .gap-2 { gap: 8px; }
        .gap-3 { gap: 12px; }
        .gap-4 { gap: 16px; }
        .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .flex-1 { flex: 1; }
        .shrink-0 { flex-shrink: 0; }
        .min-w-0 { min-width: 0; }
        .truncate { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .h-3 { height: 12px; }
        .h-4 { height: 16px; }
        .h-5 { height: 20px; }
        .h-6 { height: 24px; }
        .h-8 { height: 32px; }
        .w-3 { width: 12px; }
        .w-4 { width: 16px; }
        .w-5 { width: 20px; }
        .w-6 { width: 24px; }
        .w-8 { width: 32px; }
        .h-\[60px\] { height: 60px; }
        .p-4 { padding: 16px; }
        .px-2 { padding-left: 8px; padding-right: 8px; }
        .px-2\.5 { padding-left: 10px; padding-right: 10px; }
        .px-3 { padding-left: 12px; padding-right: 12px; }
        .px-4 { padding-left: 16px; padding-right: 16px; }
        .px-6 { padding-left: 24px; padding-right: 24px; }
        .py-1\.5 { padding-top: 6px; padding-bottom: 6px; }
        .py-3 { padding-top: 12px; padding-bottom: 12px; }
        .py-4 { padding-top: 16px; padding-bottom: 16px; }
        .py-\[9px\] { padding-top: 9px; padding-bottom: 9px; }
        .mb-2 { margin-bottom: 8px; }
        .mt-2 { margin-top: 8px; }
        .my-3\.5 { margin-top: 14px; margin-bottom: 14px; }
        .rounded-lg { border-radius: 8px; }
        .rounded-md { border-radius: 6px; }
        .rounded-xl { border-radius: 12px; }
        .rounded-full { border-radius: 9999px; }
        .text-\[9px\] { font-size: 9px; }
        .text-\[10px\] { font-size: 10px; }
        .text-\[11px\] { font-size: 11px; }
        .text-\[12px\] { font-size: 12px; }
        .text-\[12\.5px\] { font-size: 12.5px; }
        .text-\[13px\] { font-size: 13px; }
        .text-\[15px\] { font-size: 15px; }
        .text-\[20px\] { font-size: 20px; }
        .font-bold { font-weight: 700; }
        .font-medium { font-weight: 500; }
        .font-semibold { font-weight: 600; }
        .tracking-wide { letter-spacing: 0.025em; }
        .tracking-\[0\.1em\] { letter-spacing: 0.1em; }
        .leading-tight { line-height: 1.25; }
        .text-white { color: #fff; }
        .text-center { text-align: center; }
        .uppercase { text-transform: uppercase; }
        .antialiased { -webkit-font-smoothing: antialiased; }
        .fixed { position: fixed; }
        .absolute { position: absolute; }
        .relative { position: relative; }
        .sticky { position: sticky; }
        .inset-0 { top: 0; right: 0; bottom: 0; left: 0; }
        .inset-y-0 { top: 0; bottom: 0; }
        .left-0 { left: 0; }
        .top-0 { top: 0; }
        .right-0 { right: 0; }
        .z-30 { z-index: 30; }
        .z-40 { z-index: 40; }
        .z-50 { z-index: 50; }
        .min-h-screen { min-height: 100vh; }
        .overflow-y-auto { overflow-y: auto; }
        .overflow-hidden { overflow: hidden; }
        .hidden { display: none; }
        .block { display: block; }

        /* RESPONSIVE */
        @media (min-width: 640px) {
            .sm\:flex { display: flex; }
            .sm\:hidden { display: none; }
            .sm\:table-cell { display: table-cell; }
            .sm\:inline { display: inline; }
            .sm\:block { display: block; }
        }

        @media (min-width: 768px) {
            .md\:inline { display: inline; }
            .md\:hidden { display: none; }
            .md\:table-cell { display: table-cell; }
        }

        @media (min-width: 1024px) {
            .lg\:flex { display: flex; }
            .lg\:hidden { display: none; }
            .lg\:px-6 { padding-left: 24px; padding-right: 24px; }
            .lg\:p-6 { padding: 24px; }
            .lg\:table-cell { display: table-cell; }
        }

        @media (min-width: 1280px) {
            .xl\:table-cell { display: table-cell; }
        }

        .space-y-0\.5 > * + * { margin-top: 2px; }
        .gap-0\.5 { gap: 2px; }
        .gap-1\.5 { gap: 6px; }
        .gap-2\.5 { gap: 10px; }

        /* MINI CHART */
        .mini-chart {
            display: flex;
            align-items: flex-end;
            gap: 3px;
            height: 40px;
        }
        .mini-chart-bar {
            width: 6px;
            border-radius: 3px 3px 0 0;
            background: var(--accent-blue);
            opacity: 0.6;
            transition: opacity 0.2s ease, height 0.6s ease;
        }
        .mini-chart-bar:hover { opacity: 1; }
        .mini-chart-bar:nth-child(1) { height: 40%; }
        .mini-chart-bar:nth-child(2) { height: 65%; }
        .mini-chart-bar:nth-child(3) { height: 45%; }
        .mini-chart-bar:nth-child(4) { height: 80%; }
        .mini-chart-bar:nth-child(5) { height: 55%; }
        .mini-chart-bar:nth-child(6) { height: 70%; }
        .mini-chart-bar:nth-child(7) { height: 90%; }

        /* RING PROGRESS */
        .ring-progress {
            position: relative;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #e5edf6;
        }
        .ring-progress::after {
            content: '';
            position: absolute;
            inset: 3px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: var(--accent-blue);
            animation: ring-spin 2s linear infinite;
        }
        @keyframes ring-spin { to { transform: rotate(360deg); } }
        .ring-center {
            position: absolute;
            inset: 10px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        /* LIGHT THEME OVERRIDE */
        .sidebar-bg .nav-link { color: #dbeafe !important; }
        .sidebar-bg .nav-link.active { background: rgba(255,255,255,0.14) !important; color: #ffffff !important; }
        .sidebar-bg .nav-link:hover:not(.active) { background: rgba(255,255,255,0.08) !important; color: #ffffff !important; }
        .sidebar-bg nav > p { color: #93c5fd !important; }
        .sidebar-bg .text-white { color: #ffffff !important; }
        .sidebar-bg [style*="--text-muted"] { color: #bfdbfe !important; }
        .sidebar-bg [style*="--text-dim"] { color: #bfdbfe !important; }
        .sidebar-bg .border-t { border-color: rgba(255,255,255,0.10) !important; }
        .card, .stat-card { box-shadow: 0 2px 10px rgba(15,23,42,0.05); }
        .btn-outline:hover { background: rgba(37,99,235,0.06); }
        footer { color: var(--text-muted); }
    </style>
</head>

<body class="font-sans antialiased">

    <div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 z-40 lg:hidden" onclick="toggleSidebar()"></div>

    <div class="min-h-screen flex relative" style="z-index: 1;">

        <!-- =====================================================
             SIDEBAR
             ===================================================== -->
        <aside id="sidebarPanel" class="sidebar-panel sidebar-bg fixed inset-y-0 left-0 z-50 flex flex-col">

            <!-- LOGO -->
            <div class="h-20 flex items-center justify-between px-5 border-b border-white/10 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full overflow-hidden shrink-0 border border-white/20 bg-slate-950 flex items-center justify-center">
                        <img src="{{ asset('images/image.png') }}" alt="Logo PKL" class="w-full h-full object-cover scale-125">
                    </div>
                    <div class="min-w-0">
                        <h1 class="text-[13px] font-bold tracking-wide text-white leading-tight">MANEJEMEN PKL</h1>
                        <p class="text-[9px] font-medium" style="color: #93c5fd;">Sistem Informasi</p>
                    </div>
                </div>
            </div>

            <!-- NAVIGATION -->
            <nav class="sidebar-scroll flex-1 px-2.5 py-4 overflow-y-auto">
                <p class="mb-2 px-2.5 text-[9px] font-bold uppercase tracking-[0.1em]" style="color: #93c5fd;">Menu</p>
                
                <div class="space-y-0.5">
                    <!-- DASHBOARD -->
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center gap-2.5 px-2.5 py-[9px] text-[12.5px] font-medium">
                        <i data-lucide="layout-dashboard" class="h-4 w-4 shrink-0"></i>
                        Dashboard
                    </a>

                    <!-- DATA SISWA -->
                    <a href="{{ route('admin.siswa.index') }}" class="nav-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }} flex items-center gap-2.5 px-2.5 py-[9px] text-[12.5px] font-medium">
                        <i data-lucide="graduation-cap" class="h-4 w-4 shrink-0"></i>
                        Data Siswa
                    </a>

                    <!-- DATA GURU -->
                    <a href="{{ route('admin.guru.index') }}" class="nav-link {{ request()->routeIs('admin.guru.*') ? 'active' : '' }} flex items-center gap-2.5 px-2.5 py-[9px] text-[12.5px] font-medium">
                        <i data-lucide="users" class="h-4 w-4 shrink-0"></i>
                        Data Guru
                    </a>

                    <!-- TEMPAT PKL -->
                    <a href="{{ route('admin.tempat.index') }}" class="nav-link {{ request()->routeIs('admin.tempat.*') ? 'active' : '' }} flex items-center gap-2.5 px-2.5 py-[9px] text-[12.5px] font-medium">
                        <i data-lucide="building-2" class="h-4 w-4 shrink-0"></i>
                        Tempat PKL
                    </a>

                    <!-- PENGAJUAN PKL -->
                    <a href="{{ route('admin.pengajuan.index') }}" class="nav-link {{ request()->routeIs('admin.pengajuan.*') ? 'active' : '' }} flex items-center gap-2.5 px-2.5 py-[9px] text-[12.5px] font-medium">
                        <i data-lucide="file-text" class="h-4 w-4 shrink-0"></i>
                        <span class="flex-1">Pengajuan PKL</span>
                        
                        @php
                            $pendingCount = 0;
                            if (class_exists(\App\Models\PengajuanPkl::class)) {
                                $pendingCount = \App\Models\PengajuanPkl::where('status', 'menunggu')->count() ?? 0;
                            }
                        @endphp

                        @if($pendingCount > 0)
                            <span class="flex h-[18px] min-w-[18px] items-center justify-center rounded-md px-1 text-[9px] font-bold" style="background: #fef3c7; color: #92400e;">
                                {{ $pendingCount }}
                            </span>
                        @endif
                    </a>
                </div>
            </nav>

            <!-- PROFILE / LOGOUT -->
            <div class="shrink-0 px-3 py-3" style="border-top: 1px solid rgba(255,255,255,0.10); background: rgba(18,59,109,0.98);">
                <div class="flex items-center gap-2.5">
                    <div class="avatar h-8 w-8 text-[11px]" style="background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-[12px] font-semibold text-white leading-tight">
                            {{ Auth::user()->name ?? 'User' }}
                        </p>
                        <p class="text-[10px]" style="color: #bfdbfe;">
                            {{ ucfirst(Auth::user()->role ?? 'User') }}
                        </p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                        @csrf
                        <button type="submit" title="Logout" aria-label="Logout" class="flex h-7 w-7 items-center justify-center rounded-md transition" style="color: #bfdbfe;" onmouseover="this.style.background='rgba(239,68,68,0.15)';this.style.color='#fca5a5';" onmouseout="this.style.background='transparent';this.style.color='#bfdbfe';">
                            <i data-lucide="log-out" class="h-3.5 w-3.5" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- =====================================================
             MAIN CONTENT
             ===================================================== -->
        <div class="main-content min-h-screen flex flex-col flex-1">
            <!-- TOPBAR -->
            <header class="topbar-bg sticky top-0 z-30 flex h-[60px] items-center justify-between px-4 lg:px-6">
                <div class="flex items-center gap-3">
                    <button type="button" onclick="toggleSidebar()" aria-label="Buka menu navigasi" class="flex h-8 w-8 items-center justify-center rounded-md lg:hidden transition hover:bg-blue-50" style="color: var(--text-secondary);">
                        <i data-lucide="menu" class="h-[18px] w-[18px]" aria-hidden="true"></i>
                    </button>
                    @isset($header)
                        {{ $header }}
                    @endisset
                </div>
                
                <div class="flex items-center gap-2">
                    <!-- DATE -->
                    <div class="hidden items-center gap-1.5 rounded-lg px-2.5 py-1.5 text-[11px] font-medium sm:flex input-dark">
                        <i data-lucide="calendar-days" class="h-3 w-3" style="color: var(--accent-blue);"></i>
                        <span class="hidden md:inline">
                            {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                        </span>
                        <span class="md:hidden">
                            {{ \Carbon\Carbon::now()->format('d M Y') }}
                        </span>
                    </div>

                    {{-- <button class="relative flex h-8 w-8 items-center justify-center rounded-lg input-dark transition hover:bg-blue-50" style="color: var(--text-secondary);">
                        <i data-lucide="bell" class="h-[15px] w-[15px]"></i>
                        <span class="pulse-dot absolute right-1.5 top-1.5 h-[6px] w-[6px] rounded-full bg-red-500"></span>
                    </button> --}}

                    <!-- USER AVATAR -->
                    <div class="hidden h-8 w-8 items-center justify-center rounded-lg text-[11px] font-bold text-white sm:flex" style="background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                </div>
            </header>

            <!-- PAGE -->
            <main class="flex-1 p-4 lg:p-6">
                {{ $slot }}
            </main>

            <!-- FOOTER -->
            <footer class="px-6 py-3 text-center text-[10px]" style="border-top: 1px solid var(--border); color: var(--text-muted);">
                &copy; {{ date('Y') }} Sistem Informasi Jurnal PKL
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        lucide.createIcons();

        function toggleSidebar() {
            const s = document.getElementById('sidebarPanel');
            const o = document.getElementById('sidebarOverlay');
            const open = s.classList.contains('open');

            s.classList.toggle('open', !open);
            o.classList.toggle('open', !open);
            document.body.classList.toggle('sidebar-open', !open);
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                document.getElementById('sidebarPanel').classList.remove('open');
                document.getElementById('sidebarOverlay').classList.remove('open');
                document.body.classList.remove('sidebar-open');
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const SwalDark = Swal.mixin({
                background: '#ffffff',
                color: '#172033',
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#dc2626',
            });

            const deleteForms = document.querySelectorAll('form.form-delete');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const confirmMessage = form.getAttribute('data-confirm-message') || "Data yang dihapus tidak dapat dikembalikan!";

                    SwalDark.fire({
                        title: 'Yakin ingin menghapus?',
                        text: confirmMessage,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                        position: 'center',
                        customClass: {
                            popup: 'swal2-dark-popup'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    
    <style>
        .swal2-container {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            inset: 0 !important;
        }
        .swal2-dark-popup {
            border: 1px solid #dbe3ef !important;
            box-shadow: 0 12px 40px rgba(15,23,42,0.15) !important;
        }
        .swal2-styled.swal2-confirm {
            border-radius: 8px !important;
            font-weight: 600 !important;
        }
        .swal2-styled.swal2-cancel {
            border-radius: 8px !important;
            font-weight: 600 !important;
        }
    </style>
</body>
</html>