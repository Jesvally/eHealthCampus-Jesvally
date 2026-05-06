@extends('layouts.app')

@section('content')
    <div class="auth-body">
        <div class="auth-card">
            <h2 class="brand-text">E-Health Campus</h2>
            <p style="color: gray; margin-bottom: 20px;">Are you sure you want to log out?</p>

            {{-- Error Messages --}}
            @if ($errors->any())
                <div style="color: #e74c3c; font-size: 13px; margin-bottom: 10px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Logout Confirmation Form --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="logout-buttons">
                    <button type="submit" class="btn btn-danger">Yes, Log me out</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection