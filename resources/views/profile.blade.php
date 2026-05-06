@extends('layouts.app')

@section('content')
    <div class="sidebar">
        <div class="sidebar-logo"><div class="logo-box">❤️</div><h3>E-Health</h3></div>
        <nav>
            <a href="{{ route('dashboard') }}" class="nav-item">🏠 Dashboard</a>
            <a href="{{ route('rekam-medis') }}" class="nav-item">📁 Medical Records</a>
             <div class="nav-bottom">
                <form action="{{ route('logout') }}" method="POST" style="margin:0; padding:0;">
                    @csrf
                    <button type="submit" class="nav-item" style="background:none; border:none; cursor:pointer; width:100%; text-align:left; color:rgba(255,255,255,0.7); font-size:14px; font-weight:600;">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </nav>
    </div>
    <div class="main-content" style="display: flex; flex-direction: column; align-items: center;">
        <div style="width: 100%; max-width: 600px;">
            <a href="{{ route('dashboard') }}" style="text-decoration:none; color:#26a69a; font-weight:bold;">← Back</a>
            <div class="content-card" style="margin-top:20px; text-align: center;">
                <div class="avatar" style="width: 70px; height: 70px; margin: 0 auto 15px; font-size: 22px;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <h2>{{ auth()->user()->name }}</h2>
                <p style="color: gray; margin-bottom: 25px;">{{ auth()->user()->nim }}</p>
                <form method="POST" class="profile-form" style="text-align: left;">
                    @csrf
                    <label style="font-size: 13px; color: gray; display: block; margin-bottom: 5px;">Age (Years)</label>
                    <input type="number" name="umur" value="{{ auth()->user()->profile['umur'] ?? '' }}">
                    <label style="font-size: 13px; color: gray; display: block; margin-bottom: 5px;">Height (cm)</label>
                    <input type="number" name="tb" value="{{ auth()->user()->profile['tb'] ?? '' }}">
                    <label style="font-size: 13px; color: gray; display: block; margin-bottom: 5px;">Weight (kg)</label>
                    <input type="number" name="bb" value="{{ auth()->user()->profile['bb'] ?? '' }}">
                    <button type="submit" name="update_profile">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection