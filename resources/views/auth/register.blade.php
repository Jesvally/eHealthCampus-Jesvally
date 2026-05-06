@extends('layouts.app')

@section('content')
    <div class="auth-body">
        <div class="auth-card">
            <h2 class="brand-text">E-Health Campus</h2>
            <p style="color: gray; margin-bottom: 20px;">Create your student account</p>

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

            <form method="POST" action="{{ route('register.process') }}">
                @csrf
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <input type="text" name="nim" placeholder="Student ID (NIM)" value="{{ old('nim') }}" required>
                <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                <input type="number" name="umur" placeholder="Age" value="{{ old('umur') }}" required>
                <input type="number" name="height" placeholder="Height (cm)" value="{{ old('height') }}" required>
                <input type="number" name="weight" placeholder="Weight (kg)" value="{{ old('weight') }}" required>
                
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

                <button type="submit">Register Account</button>
            </form>
            
            <p style="margin-top: 20px; font-size: 14px; color: gray;">Already have an account? <a href="{{ route('login') }}" style="color:#26a69a; text-decoration:none; font-weight:bold;">Login here</a></p>
        </div>
    </div>
@endsection