@extends('layouts.app')

@section('content')
    {{-- ===== SIDEBAR ===== --}}
    <div class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-box">❤️</div>
            <h3>E-Health</h3>
        </div>
        <nav>
            <a href="{{ route('dashboard') }}" class="nav-item">🏠 Dashboard</a>
            <a href="{{ route('rekam-medis') }}" class="nav-item">📁 Medical Records</a>
            <a href="{{ route('sleep.index') }}" class="nav-item active">🛏️ Sleep Tracker</a>
            <a href="{{ route('profile') }}" class="nav-item">👤 Profile</a>
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

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="main-content">
        <header class="top-header">
            <div>
                <h1>Sleep Tracker 🛏️</h1>
                <p>Monitor your sleep quality and consistency.</p>
            </div>
        </header>

        {{-- Flash Messages --}}
        @if(session('warning') || session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @endif
        @if(session('warning'))
        <script>Swal.fire({icon:'warning',title:'Poor Sleep Quality',text:'{{ session("warning") }}',confirmButtonColor:'#26a69a'});</script>
        @endif
        @if(session('success'))
        <script>Swal.fire({icon:'success',title:'Saved!',text:'{{ session("success") }}',timer:2000,showConfirmButton:false});</script>
        @endif

        {{-- ===== FORM INPUT ===== --}}
        <div class="content-card">
            <div class="card-header"><h3>📝 Log Sleep Record</h3></div>
            <form action="{{ route('sleep.store') }}" method="POST" class="inline-form">
                @csrf
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" value="{{ now()->toDateString() }}" max="{{ now()->toDateString() }}" required>
                </div>
                <div class="form-group">
                    <label>Sleep Time</label>
                    <input type="time" name="sleep_time" required>
                </div>
                <div class="form-group">
                    <label>Wake Time</label>
                    <input type="time" name="wake_time" required>
                </div>
                <button type="submit">Save Sleep</button>
            </form>
        </div>

        {{-- ===== SLEEP SUMMARY CARD ===== --}}
        @if($latest && $latestDuration)
        <div class="sleep-summary-card">
            <div class="sleep-time-box">
                <div class="label">Sleep time</div>
                <div class="sublabel">{{ \Carbon\Carbon::parse($latest->date)->format('d M Y') }}</div>
                <div class="duration">
                    🛌 {{ $latestDuration['hours'] }}<span>h</span> {{ $latestDuration['minutes'] }}<span>m</span>
                </div>
                <div class="time-range">
                    {{ \Carbon\Carbon::parse($latest->sleep_time)->format('g:i a') }}
                    &mdash;
                    {{ \Carbon\Carbon::parse($latest->wake_time)->format('g:i a') }}
                </div>
            </div>

            <div class="sleep-consistency-box">
                <div class="label">Sleep consistency</div>
                <div class="sublabel">Target achieved {{ $last7Days->where('has_record', true)->count() }} out of 7 days</div>
                <div class="dot-row">
                    <span class="icon">🛌</span>
                    @foreach($last7Days as $day)
                        <div class="dot {{ $day['has_record'] ? 'filled' : 'empty' }}"></div>
                    @endforeach
                </div>
                <div class="dot-divider"></div>
                <div class="dot-row">
                    <span class="icon">⏰</span>
                    @foreach($last7Days as $day)
                        <div class="dot {{ $day['has_record'] ? 'filled' : 'empty' }}"></div>
                    @endforeach
                </div>
                <div class="date-row">
                    @foreach($last7Days as $day)
                        <span class="date-label {{ $day['date'] === now()->toDateString() ? 'today' : '' }}">
                            {{ $day['day'] }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- ===== SLEEP HISTORY TABLE ===== --}}
        <div class="content-card">
            <div class="card-header">
                <h3>📋 Sleep History</h3>
                <span style="font-size:13px; color:#a4b0be;">{{ $records->count() }} total records</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Sleep Time</th>
                        <th>Wake Time</th>
                        <th>Duration</th>
                        <th>Quality</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $record)
                        @php
                            $s = \Carbon\Carbon::parse($record->sleep_time);
                            $w = \Carbon\Carbon::parse($record->wake_time);
                            if ($w->lessThan($s)) $w->addDay();
                            $hrs  = $s->diffInHours($w);
                            $mins = $s->diffInMinutes($w) % 60;
                            $quality = $hrs >= 7 && $hrs <= 9 ? 'Good' : ($hrs < 7 ? 'Short' : 'Long');
                            $qualityClass = $quality === 'Good' ? 'tag-safe' : 'tag-warn';
                        @endphp
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($record->sleep_time)->format('g:i a') }}</td>
                            <td>{{ \Carbon\Carbon::parse($record->wake_time)->format('g:i a') }}</td>
                            <td style="font-weight:700;">{{ $hrs }}h {{ $mins }}m</td>
                            <td><span class="status-tag {{ $qualityClass }}">{{ $quality }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; color:#a4b0be; padding:50px;">
                                <div style="font-size:32px; margin-bottom:10px;">😴</div>
                                No sleep records yet. Log your first sleep above!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
