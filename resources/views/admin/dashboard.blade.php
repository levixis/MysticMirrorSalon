<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Mystic Mirror Salon</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('favicon.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.jpg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0a;
            color: #f5f0e8;
            min-height: 100vh;
        }
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(201,168,76,0.03) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(201,168,76,0.02) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Admin Navbar */
        .admin-nav {
            background: rgba(17,17,17,0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(201,168,76,0.3);
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .admin-nav-inner {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
        }
        .admin-nav .brand {
            font-family: 'Great Vibes', cursive;
            font-size: 1.6rem;
            color: #c9a84c;
            text-decoration: none;
        }
        .admin-nav .brand span {
            font-family: 'Inter', sans-serif;
            font-size: 0.75rem;
            color: #b0a890;
            margin-left: 0.5rem;
            background: rgba(201,168,76,0.15);
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .admin-nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .admin-nav-actions a {
            color: #b0a890;
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.3s;
        }
        .admin-nav-actions a:hover { color: #c9a84c; }
        .btn-logout {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.3);
            color: #ef4444;
            padding: 0.4rem 1rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s;
        }
        .btn-logout:hover {
            background: rgba(239,68,68,0.25);
        }

        /* Main Content */
        .admin-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: #1a1a1a;
            border: 1px solid rgba(201,168,76,0.2);
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s;
        }
        .stat-card:hover {
            border-color: rgba(201,168,76,0.5);
            transform: translateY(-2px);
        }
        .stat-card .stat-label {
            color: #b0a890;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }
        .stat-card .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #c9a84c;
        }
        .stat-card .stat-icon {
            float: right;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }
        .stat-icon.total { background: rgba(201,168,76,0.15); color: #c9a84c; }
        .stat-icon.pending { background: rgba(234,179,8,0.15); color: #eab308; }
        .stat-icon.approved { background: rgba(34,197,94,0.15); color: #22c55e; }
        .stat-icon.cancelled { background: rgba(239,68,68,0.15); color: #ef4444; }
        .stat-icon.revenue { background: rgba(99,102,241,0.15); color: #818cf8; }
        .stat-icon.monthly { background: rgba(168,85,247,0.15); color: #a855f7; }

        .stat-card.pending .stat-value { color: #eab308; }
        .stat-card.approved .stat-value { color: #22c55e; }
        .stat-card.cancelled .stat-value { color: #ef4444; }
        .stat-card.revenue .stat-value { color: #818cf8; }
        .stat-card.monthly .stat-value { color: #a855f7; }

        /* Quick Actions Row */
        .quick-actions {
            display: flex;
            gap: 0.8rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        .btn-quick {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
            text-decoration: none;
        }
        .btn-receipt {
            background: linear-gradient(135deg, #c9a84c, #9e7b2a);
            color: #0a0a0a;
        }
        .btn-receipt:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(201,168,76,0.3);
        }
        .btn-export {
            background: rgba(99,102,241,0.15);
            color: #818cf8;
            border: 1px solid rgba(99,102,241,0.3);
        }
        .btn-export:hover {
            background: rgba(99,102,241,0.25);
        }
        .btn-export-purple {
            background: rgba(168,85,247,0.15);
            color: #a855f7;
            border: 1px solid rgba(168,85,247,0.3);
        }
        .btn-export-purple:hover {
            background: rgba(168,85,247,0.25);
        }

        /* Dashboard Tabs */
        .dashboard-tabs {
            display: flex;
            gap: 0;
            margin-bottom: 0;
            border-bottom: 1px solid rgba(201,168,76,0.2);
        }
        .dash-tab {
            padding: 0.8rem 1.5rem;
            color: #888;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            background: none;
            font-family: 'Inter', sans-serif;
            position: relative;
            transition: all 0.3s;
        }
        .dash-tab:hover { color: #c9a84c; }
        .dash-tab.active {
            color: #c9a84c;
        }
        .dash-tab.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0; right: 0;
            height: 2px;
            background: #c9a84c;
        }
        .dash-tab i { margin-right: 0.4rem; }

        /* Tab Content */
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }

        /* Section Card */
        .section-card {
            background: #1a1a1a;
            border: 1px solid rgba(201,168,76,0.2);
            border-radius: 0 0 12px 12px;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid rgba(201,168,76,0.15);
        }
        .section-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            color: #c9a84c;
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            padding: 1rem 1.5rem;
            flex-wrap: wrap;
        }
        .filter-tab {
            padding: 0.4rem 1rem;
            border-radius: 50px;
            border: 1px solid rgba(201,168,76,0.2);
            background: transparent;
            color: #b0a890;
            font-family: 'Inter', sans-serif;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }
        .filter-tab:hover, .filter-tab.active {
            background: rgba(201,168,76,0.15);
            border-color: #c9a84c;
            color: #c9a84c;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead th {
            text-align: left;
            padding: 0.8rem 1.2rem;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #b0a890;
            border-bottom: 1px solid rgba(201,168,76,0.15);
        }
        tbody tr {
            border-bottom: 1px solid rgba(255,255,255,0.03);
            transition: background 0.2s;
        }
        tbody tr:hover {
            background: rgba(201,168,76,0.03);
        }
        tbody td {
            padding: 0.8rem 1.2rem;
            font-size: 0.88rem;
            color: #e8e0d0;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 0.2rem 0.65rem;
            border-radius: 50px;
            font-size: 0.68rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-pending { background: rgba(234,179,8,0.15); color: #eab308; border: 1px solid rgba(234,179,8,0.3); }
        .badge-approved { background: rgba(34,197,94,0.15); color: #22c55e; border: 1px solid rgba(34,197,94,0.3); }
        .badge-cancelled { background: rgba(239,68,68,0.15); color: #ef4444; border: 1px solid rgba(239,68,68,0.3); }
        .badge-men { background: rgba(59,130,246,0.15); color: #3b82f6; border: 1px solid rgba(59,130,246,0.3); }
        .badge-women { background: rgba(236,72,153,0.15); color: #ec4899; border: 1px solid rgba(236,72,153,0.3); }

        /* Action Buttons */
        .action-btns { display: flex; gap: 0.4rem; }
        .btn-action {
            padding: 0.3rem 0.7rem;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
        }
        .btn-approve { background: rgba(34,197,94,0.15); color: #22c55e; border: 1px solid rgba(34,197,94,0.3); }
        .btn-approve:hover { background: rgba(34,197,94,0.25); }
        .btn-cancel { background: rgba(239,68,68,0.15); color: #ef4444; border: 1px solid rgba(239,68,68,0.3); }
        .btn-cancel:hover { background: rgba(239,68,68,0.25); }
        .btn-edit { background: rgba(59,130,246,0.15); color: #3b82f6; border: 1px solid rgba(59,130,246,0.3); }
        .btn-edit:hover { background: rgba(59,130,246,0.25); }
        .btn-delete { background: rgba(239,68,68,0.15); color: #ef4444; border: 1px solid rgba(239,68,68,0.3); }
        .btn-delete:hover { background: rgba(239,68,68,0.25); }
        .btn-toggle { background: rgba(234,179,8,0.15); color: #eab308; border: 1px solid rgba(234,179,8,0.3); }
        .btn-toggle:hover { background: rgba(234,179,8,0.25); }
        .btn-toggle.active { background: rgba(34,197,94,0.15); color: #22c55e; border: 1px solid rgba(34,197,94,0.3); }
        .btn-download { background: rgba(201,168,76,0.15); color: #c9a84c; border: 1px solid rgba(201,168,76,0.3); }
        .btn-download:hover { background: rgba(201,168,76,0.25); }

        /* Alert */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        .alert-success {
            background: rgba(34,197,94,0.1);
            border: 1px solid rgba(34,197,94,0.3);
            color: #22c55e;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #666;
        }
        .empty-state i {
            font-size: 2.5rem;
            margin-bottom: 0.8rem;
            color: rgba(201,168,76,0.3);
        }
        .empty-state p { font-size: 0.95rem; }

        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.show { display: flex; }
        .modal {
            background: #1a1a1a;
            border: 1px solid rgba(201,168,76,0.3);
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            padding: 2rem;
            animation: fadeInUp 0.3s ease;
        }
        .modal-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            color: #c9a84c;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-close {
            background: none;
            border: none;
            color: #888;
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.3s;
        }
        .modal-close:hover { color: #ef4444; }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            color: #b0a890;
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.4rem;
        }
        .form-control {
            width: 100%;
            padding: 0.7rem 1rem;
            background: #111;
            border: 1px solid rgba(201,168,76,0.2);
            border-radius: 8px;
            color: #f5f0e8;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        .form-control:focus {
            outline: none;
            border-color: #c9a84c;
            box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
        }
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23c9a84c' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
        }
        .btn-submit {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(135deg, #c9a84c, #9e7b2a);
            color: #0a0a0a;
            border: none;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 0.5rem;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(201,168,76,0.3);
        }

        /* Instagram Card */
        .ig-add-form {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(201,168,76,0.1);
        }
        .ig-form-row {
            display: flex;
            gap: 0.8rem;
            align-items: flex-end;
        }
        .ig-form-row .form-group { flex: 1; margin-bottom: 0; }
        .ig-form-row .btn-submit { width: auto; margin-top: 0; padding: 0.7rem 1.5rem; white-space: nowrap; }
        .ig-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.8rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }
        .ig-item:hover { background: rgba(201,168,76,0.03); }
        .ig-url {
            color: #e8e0d0;
            font-size: 0.85rem;
            word-break: break-all;
            flex: 1;
            margin-right: 1rem;
        }
        .ig-url a { color: #c9a84c; text-decoration: none; }
        .ig-url a:hover { text-decoration: underline; }
        .ig-caption {
            color: #888;
            font-size: 0.78rem;
            margin-top: 0.2rem;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .section-card { overflow-x: auto; }
            table { min-width: 700px; }
            .ig-form-row { flex-direction: column; }
            .ig-form-row .btn-submit { width: 100%; }
        }
        @media (max-width: 500px) {
            .admin-content { padding: 1rem; }
            .quick-actions { flex-direction: column; }
            .dashboard-tabs { overflow-x: auto; }
        }
    </style>
</head>
<body>
    <!-- Admin Navigation -->
    <nav class="admin-nav">
        <div class="admin-nav-inner">
            <a href="{{ route('admin.dashboard') }}" class="brand">
                Mystic Mirror <span>Admin</span>
            </a>
            <div class="admin-nav-actions">
                <a href="{{ route('home') }}" target="_blank"><i class="fas fa-external-link-alt"></i> View Site</a>
                <button onclick="openModal('changePasswordModal')" class="btn-logout" style="background: rgba(201,168,76,0.15); color: #c9a84c; border-color: rgba(201,168,76,0.3);">
                    <i class="fas fa-key"></i> Change Password
                </button>
                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="admin-content">
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="alert" style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #ef4444;">
                <i class="fas fa-exclamation-circle"></i>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card revenue">
                <div class="stat-icon revenue"><i class="fas fa-rupee-sign"></i></div>
                <div class="stat-label">Today's Revenue</div>
                <div class="stat-value">₹{{ number_format($todayRevenue) }}</div>
            </div>
            <div class="stat-card monthly">
                <div class="stat-icon monthly"><i class="fas fa-chart-line"></i></div>
                <div class="stat-label">Monthly Revenue</div>
                <div class="stat-value">₹{{ number_format($monthlyRevenue) }}</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <a href="{{ route('admin.receipt.create') }}" class="btn-quick btn-receipt">
                <i class="fas fa-receipt"></i> Generate Receipt / Bill
            </a>
            <a href="{{ route('admin.revenue.export', 'daily') }}" class="btn-quick btn-export">
                <i class="fas fa-file-excel"></i> Export Today's Revenue
            </a>
            <a href="{{ route('admin.revenue.export', 'monthly') }}" class="btn-quick btn-export-purple">
                <i class="fas fa-file-excel"></i> Export Monthly Revenue
            </a>
            <button class="btn-quick btn-receipt" onclick="openModal('addServiceModal')" style="background: rgba(34,197,94,0.15); color: #22c55e; border: 1px solid rgba(34,197,94,0.3);">
                <i class="fas fa-plus"></i> Add New Service
            </button>
        </div>

        <!-- Dashboard Tabs -->
        <div class="dashboard-tabs">
            <button class="dash-tab active" onclick="switchTab('services')">
                <i class="fas fa-scissors"></i> Services
            </button>
            <button class="dash-tab" onclick="switchTab('receipts')">
                <i class="fas fa-receipt"></i> Receipts
            </button>
            <button class="dash-tab" onclick="switchTab('instagram')">
                <i class="fab fa-instagram"></i> Instagram
            </button>
            <button class="dash-tab" onclick="switchTab('messages')">
                <i class="fas fa-envelope"></i> Messages
                @if($unreadMessages > 0)
                    <span class="badge" style="background: rgba(239,68,68,0.2); color: #ef4444; border: 1px solid rgba(239,68,68,0.3); margin-left: 0.3rem; font-size: 0.65rem;">{{ $unreadMessages }}</span>
                @endif
            </button>
        </div>


        <!-- ========== SERVICES TAB ========== -->
        <div class="tab-content active" id="tab-services">
            <div class="section-card">
                <div class="section-header">
                    <h2><i class="fas fa-scissors"></i> Manage Services</h2>
                    <button class="btn-action btn-approve" onclick="openModal('addServiceModal')" style="padding: 0.5rem 1rem;">
                        <i class="fas fa-plus"></i> Add Service
                    </button>
                </div>
                @if($services->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td style="color: #666;">{{ $service->id }}</td>
                                    <td style="font-weight: 500;">{{ $service->name }}</td>
                                    <td style="color: #c9a84c; font-weight: 600;">₹{{ number_format($service->price) }}/-</td>
                                    <td>
                                        <span class="badge badge-{{ $service->gender }}">
                                            {{ ucfirst($service->gender) }}
                                        </span>
                                    </td>
                                    <td style="color: #888; font-size: 0.82rem; max-width: 200px;">{{ Str::limit($service->description, 50) }}</td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn-action btn-edit" title="Edit"
                                                onclick="editService({{ $service->id }}, '{{ addslashes($service->name) }}', {{ $service->price }}, '{{ $service->gender }}', '{{ addslashes($service->description) }}')">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this service?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <i class="fas fa-scissors"></i>
                        <p>No services yet. Add your first service!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- ========== RECEIPTS TAB ========== -->
        <div class="tab-content" id="tab-receipts">
            <div class="section-card">
                <div class="section-header">
                    <h2><i class="fas fa-receipt"></i> Recent Receipts</h2>
                    <a href="{{ route('admin.receipt.create') }}" class="btn-action btn-approve" style="padding: 0.5rem 1rem; text-decoration: none;">
                        <i class="fas fa-plus"></i> New Receipt
                    </a>
                </div>
                @if($recentReceipts->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Receipt #</th>
                                <th>Customer</th>
                                <th>Services</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentReceipts as $receipt)
                                <tr>
                                    <td style="color: #c9a84c; font-weight: 600;">#{{ str_pad($receipt->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        <div style="font-weight: 500;">{{ $receipt->customer_name }}</div>
                                        @if($receipt->phone)
                                            <div style="font-size: 0.78rem; color: #888;">{{ $receipt->phone }}</div>
                                        @endif
                                    </td>
                                    <td style="font-size: 0.82rem; max-width: 200px;">
                                        {{ collect($receipt->services)->pluck('name')->implode(', ') }}
                                    </td>
                                    <td style="color: #c9a84c; font-weight: 700; font-size: 1rem;">₹{{ number_format($receipt->total) }}/-</td>
                                    <td>
                                        <span class="badge" style="background: rgba(201,168,76,0.15); color: #c9a84c; border: 1px solid rgba(201,168,76,0.3);">
                                            {{ ucfirst($receipt->payment_method) }}
                                        </span>
                                    </td>
                                    <td style="font-size: 0.82rem; color: #888;">{{ $receipt->created_at->format('d M Y, h:i A') }}</td>
                                    <td>
                                        <a href="{{ route('admin.receipt.pdf', $receipt->id) }}" class="btn-action btn-download" title="Download PDF">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <i class="fas fa-receipt"></i>
                        <p>No receipts yet. Generate your first receipt!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- ========== INSTAGRAM TAB ========== -->
        <div class="tab-content" id="tab-instagram">
            <div class="section-card">
                <div class="section-header">
                    <h2><i class="fab fa-instagram"></i> Instagram Reels Manager</h2>
                </div>

                <!-- Add Instagram URL Form -->
                <div class="ig-add-form">
                    <form action="{{ route('admin.instagram.store') }}" method="POST">
                        @csrf
                        <div class="ig-form-row" style="margin-bottom: 0.8rem;">
                            <div class="form-group">
                                <label>Instagram Reel / Post URL *</label>
                                <input type="url" name="instagram_url" class="form-control" placeholder="https://www.instagram.com/reel/DVLerJ_kT-w/" required>
                            </div>
                            <button type="submit" class="btn-submit" style="margin-top: 0; height: 42px;">
                                <i class="fas fa-plus"></i> Add Reel
                            </button>
                        </div>
                        <p style="color: #666; font-size: 0.75rem; margin-top: -0.4rem; padding-left: 0.2rem;">
                            <i class="fas fa-magic" style="color: #c9a84c;"></i>
                            Thumbnail will be auto-scraped from Instagram. You can override it below (optional).
                        </p>
                        <div class="form-group" style="margin-top: 0.6rem;">
                            <label>Manual Thumbnail Override (optional)</label>
                            <input type="url" name="thumbnail_url" class="form-control" placeholder="Leave empty for auto-scrape — or paste a custom image URL">
                        </div>
                    </form>
                </div>

                @if($instagramPosts->count() > 0)
                    @foreach($instagramPosts as $post)
                        <div class="ig-item">
                            <div class="ig-url" style="display: flex; align-items: center; gap: 0.8rem;">
                                @if($post->thumbnail_url)
                                    <img src="{{ $post->thumbnail_url }}" alt="thumb" style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid rgba(201,168,76,0.2); flex-shrink: 0;">
                                @else
                                    <div style="width: 40px; height: 40px; border-radius: 6px; background: #222; border: 1px solid rgba(201,168,76,0.15); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="fas fa-image" style="color: #444; font-size: 0.7rem;"></i>
                                    </div>
                                @endif
                                <div>
                                    <a href="{{ $post->instagram_url }}" target="_blank">
                                        <i class="fab fa-instagram"></i> {{ Str::limit($post->instagram_url, 50) }}
                                    </a>
                                    <div style="display: flex; gap: 0.4rem; margin-top: 0.2rem;">
                                        @if($post->thumbnail_url)
                                            <span class="badge" style="background: rgba(34,197,94,0.1); color: #22c55e; border: 1px solid rgba(34,197,94,0.2); font-size: 0.6rem;">
                                                <i class="fas fa-image"></i> Thumb
                                            </span>
                                        @else
                                            <span class="badge" style="background: rgba(234,179,8,0.1); color: #eab308; border: 1px solid rgba(234,179,8,0.2); font-size: 0.6rem;">
                                                No Thumb
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="action-btns">
                                <div style="display: flex; gap: 0.2rem; margin-right: 0.3rem;">
                                    <form action="{{ route('admin.instagram.move', [$post->id, 'up']) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-action" title="Move Up" style="font-size: 0.7rem; padding: 0.3rem 0.45rem; {{ $loop->first ? 'opacity: 0.3; pointer-events: none;' : '' }}">
                                            <i class="fas fa-arrow-up"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.instagram.move', [$post->id, 'down']) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-action" title="Move Down" style="font-size: 0.7rem; padding: 0.3rem 0.45rem; {{ $loop->last ? 'opacity: 0.3; pointer-events: none;' : '' }}">
                                            <i class="fas fa-arrow-down"></i>
                                        </button>
                                    </form>
                                </div>
                                <span class="badge" style="{{ $post->is_visible ? 'background: rgba(34,197,94,0.15); color: #22c55e; border: 1px solid rgba(34,197,94,0.3);' : 'background: rgba(239,68,68,0.15); color: #ef4444; border: 1px solid rgba(239,68,68,0.3);' }}">
                                    {{ $post->is_visible ? 'Visible' : 'Hidden' }}
                                </span>
                                <form action="{{ route('admin.instagram.toggle', $post->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-action {{ $post->is_visible ? 'btn-toggle active' : 'btn-toggle' }}" title="Toggle Visibility">
                                        <i class="fas fa-{{ $post->is_visible ? 'eye' : 'eye-slash' }}"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.instagram.destroy', $post->id) }}" method="POST"
                                    onsubmit="return confirm('Remove this reel?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fab fa-instagram"></i>
                        <p>No Instagram reels added yet. Paste a reel URL above to get started!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- ========== MESSAGES TAB ========== -->
        <div class="tab-content" id="tab-messages">
            <div class="section-card">
                <div class="section-header">
                    <h2><i class="fas fa-envelope"></i> Contact Messages</h2>
                    <span style="color: #888; font-size: 0.8rem;">{{ $contactMessages->count() }} messages</span>
                </div>
                @if($contactMessages->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contactMessages as $msg)
                                <tr style="{{ !$msg->is_read ? 'background: rgba(201,168,76,0.03);' : '' }}">
                                    <td>
                                        @if(!$msg->is_read)
                                            <span class="badge badge-pending"><i class="fas fa-circle" style="font-size: 0.5rem;"></i> New</span>
                                        @else
                                            <span class="badge" style="background: rgba(100,100,100,0.15); color: #888; border: 1px solid rgba(100,100,100,0.3);">Read</span>
                                        @endif
                                    </td>
                                    <td style="font-weight: {{ !$msg->is_read ? '600' : '400' }};">{{ $msg->name }}</td>
                                    <td>
                                        <div style="font-size: 0.82rem;">{{ $msg->email }}</div>
                                        <div style="font-size: 0.78rem; color: #888;">{{ $msg->phone }}</div>
                                    </td>
                                    <td style="font-size: 0.82rem; max-width: 250px;">{{ Str::limit($msg->message, 80) }}</td>
                                    <td style="font-size: 0.78rem; color: #888; white-space: nowrap;">{{ $msg->created_at->format('d M, h:i A') }}</td>
                                    <td>
                                        <div class="action-btns">
                                            @if(!$msg->is_read)
                                                <form action="{{ route('admin.messages.read', $msg->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn-action btn-approve" title="Mark as Read">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST"
                                                onsubmit="return confirm('Delete this message?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <i class="fas fa-envelope-open"></i>
                        <p>No contact messages yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- ========== ADD SERVICE MODAL ========== -->
    <div class="modal-overlay" id="addServiceModal">
        <div class="modal">
            <div class="modal-title">
                <span><i class="fas fa-plus-circle"></i> Add New Service</span>
                <button class="modal-close" onclick="closeModal('addServiceModal')">&times;</button>
            </div>
            <form action="{{ route('admin.services.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Service Name *</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Haircut & Styling" required>
                </div>
                <div class="form-group">
                    <label>Price (₹) *</label>
                    <input type="number" name="price" class="form-control" placeholder="e.g. 499" min="1" required>
                </div>
                <div class="form-group">
                    <label>Category *</label>
                    <select name="gender" class="form-control" required>
                        <option value="men">👨 Men</option>
                        <option value="women">👩 Women</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Brief description...">
                </div>
                <button type="submit" class="btn-submit">Add Service</button>
            </form>
        </div>
    </div>

    <!-- ========== CHANGE PASSWORD MODAL ========== -->
    <div class="modal-overlay" id="changePasswordModal">
        <div class="modal">
            <div class="modal-title">
                <span><i class="fas fa-key"></i> Change Password</span>
                <button class="modal-close" onclick="closeModal('changePasswordModal')">&times;</button>
            </div>
            <form action="{{ route('admin.password.change') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Current Password *</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>New Password *</label>
                    <input type="password" name="new_password" class="form-control" minlength="6" required>
                </div>
                <div class="form-group">
                    <label>Confirm New Password *</label>
                    <input type="password" name="new_password_confirmation" class="form-control" minlength="6" required>
                </div>
                <button type="submit" class="btn-submit">Change Password</button>
            </form>
        </div>
    </div>

    <!-- ========== EDIT SERVICE MODAL ========== -->
    <div class="modal-overlay" id="editServiceModal">
        <div class="modal">
            <div class="modal-title">
                <span><i class="fas fa-pen"></i> Edit Service</span>
                <button class="modal-close" onclick="closeModal('editServiceModal')">&times;</button>
            </div>
            <form id="editServiceForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Service Name *</label>
                    <input type="text" name="name" id="editName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Price (₹) *</label>
                    <input type="number" name="price" id="editPrice" class="form-control" min="1" required>
                </div>
                <div class="form-group">
                    <label>Category *</label>
                    <select name="gender" id="editGender" class="form-control" required>
                        <option value="men">👨 Men</option>
                        <option value="women">👩 Women</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" id="editDesc" class="form-control">
                </div>
                <button type="submit" class="btn-submit">Update Service</button>
            </form>
        </div>
    </div>

    <script>
        // Tab Switching
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.dash-tab').forEach(el => el.classList.remove('active'));
            document.getElementById('tab-' + tabName).classList.add('active');
            event.currentTarget.classList.add('active');
        }

        // Modal
        function openModal(id) {
            document.getElementById(id).classList.add('show');
        }
        function closeModal(id) {
            document.getElementById(id).classList.remove('show');
        }

        // Edit Service
        function editService(id, name, price, gender, desc) {
            document.getElementById('editServiceForm').action = '/admin/services/' + id;
            document.getElementById('editName').value = name;
            document.getElementById('editPrice').value = price;
            document.getElementById('editGender').value = gender;
            document.getElementById('editDesc').value = desc;
            openModal('editServiceModal');
        }

        // Close modal on outside click
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>
