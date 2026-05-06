@extends('layouts.app')

@section('content')
    {{-- ===== SIDEBAR ===== --}}
    <div class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-box">❤️</div>
            <h3>E-Health</h3>
        </div>
        <nav>
            <a href="{{ route('dashboard') }}" class="nav-item active">🏠 Dashboard</a>
            <a href="{{ route('rekam-medis') }}" class="nav-item">📁 Medical Records</a>
            <a href="{{ route('sleep.index') }}" class="nav-item">🛏️ Sleep Tracker</a>
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

        {{-- Header --}}
        <header class="top-header">
            <div>
                <h1>Hello, {{ auth()->user()->name }} 👋</h1>
                <p>Track your health metrics daily.</p>
            </div>
            <div style="display:flex; align-items:center; gap:12px;">
                @php
                    $streak = 0;
                    $checkDate = now()->copy();
                    for ($d = 0; $d < 30; $d++) {
                        $has = \App\Models\HealthRecord::where('user_id', auth()->id())
                                ->whereDate('created_at', $checkDate->copy()->subDays($d))->exists();
                        if (!$has) break;
                        $streak++;
                    }
                @endphp
                @if($streak > 0)
                <div class="streak-badge">🔥 {{ $streak }} day streak</div>
                @endif
                <a href="{{ route('profile') }}" class="profile-pill">
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                    <div class="pill-info">
                        <span style="font-weight:700; font-size:14px;">{{ auth()->user()->name }}</span>
                        <span style="font-size:11px; color:#a4b0be;">{{ auth()->user()->nim }}</span>
                    </div>
                </a>
            </div>
        </header>

        {{-- ===== STAT CARDS ===== --}}
        @php
            $latest  = $history->first() ?? null;
            $detak   = $latest?->detak ?? 0;
            $detakOk = $detak >= 60 && $detak <= 100;
            $tensiOk = true;
            if ($latest && str_contains($latest->tensi ?? '', '/')) {
                [$sis, $dia] = explode('/', $latest->tensi);
                $tensiOk = $sis >= 90 && $sis <= 130 && $dia >= 60 && $dia <= 80;
            }
            $bmi       = auth()->user()->tb > 0
                ? round(auth()->user()->bb / pow(auth()->user()->tb / 100, 2), 1) : 0;
            $bmiLabel  = $bmi < 18.5 ? 'Underweight' : ($bmi <= 24.9 ? 'Normal' : ($bmi <= 29.9 ? 'Overweight' : 'Obese'));
            $bmiOk     = $bmi >= 18.5 && $bmi <= 24.9;
            $isHealthy = $latest?->status === 'Healthy';
        @endphp

        <div class="stats-grid">
            <div class="stat-card {{ $detakOk ? 'border-normal' : 'border-warn' }}">
                <p>Heart Rate</p>
                <h2>{{ $detak > 0 ? $detak : '--' }} <span style="font-size:14px;color:#a4b0be;">Bpm</span></h2>
                <span class="stat-indicator {{ $detakOk ? 'indicator-normal' : 'indicator-warn' }}">
                    {{ $detakOk ? '✓ Normal' : '⚠ Abnormal' }}
                </span>
            </div>
            <div class="stat-card {{ $tensiOk ? 'border-normal' : 'border-warn' }}">
                <p>Blood Pressure</p>
                <h2>{{ $latest?->tensi ?? '--/--' }}</h2>
                <span class="stat-indicator {{ $tensiOk ? 'indicator-normal' : 'indicator-warn' }}">
                    {{ $tensiOk ? '✓ Normal' : '⚠ Abnormal' }}
                </span>
            </div>
            <div class="stat-card {{ $bmiOk ? 'border-normal' : 'border-info' }}">
                <p>Physical BMI</p>
                <h2>{{ $bmi > 0 ? $bmi : '--' }}</h2>
                <span class="stat-indicator {{ $bmiOk ? 'indicator-normal' : 'indicator-info' }}">
                    {{ $bmi > 0 ? $bmiLabel : 'No Data' }}
                </span>
            </div>
            <div class="stat-card {{ $isHealthy ? 'border-normal' : 'border-warn' }}">
                <p>Latest Status</p>
                <h2 style="font-size:22px;">{{ $latest ? ($isHealthy ? '😊' : '😟') : '—' }}</h2>
                <span class="status-tag {{ $isHealthy ? 'tag-safe' : 'tag-warn' }}">
                    {{ $latest?->status ?? 'NO DATA' }}
                </span>
            </div>
        </div>

        {{-- ===== HEALTH TIP ===== --}}
        @if($latest)
        @php
            $allTips = $isHealthy ? [
                ['icon'=>'💧','title'=>'Stay Hydrated','msg'=>'Great job! Keep drinking 8 glasses of water daily to maintain your healthy status.'],
                ['icon'=>'🏃','title'=>'Keep Moving','msg'=>'Your vitals look great. 30 minutes of light exercise today will keep you energized.'],
                ['icon'=>'🥗','title'=>'Eat Well','msg'=>'Your health is on track! Maintain it with balanced meals rich in vegetables and protein.'],
            ] : [
                ['icon'=>'🩺','title'=>'Consult a Doctor','msg'=>'Your latest reading is outside the normal range. Consider consulting a healthcare professional soon.'],
                ['icon'=>'😴','title'=>'Rest & Recover','msg'=>'Make sure you\'re getting 7–9 hours of sleep and avoiding excessive caffeine or stress.'],
                ['icon'=>'🚫','title'=>'Limit Salt & Fat','msg'=>'Reduce processed food intake to help regulate your blood pressure and heart rate.'],
            ];
            $tip = $allTips[array_rand($allTips)];
        @endphp
        <div class="health-tip {{ $isHealthy ? '' : 'tip-warn' }}">
            <div class="health-tip-icon">{{ $tip['icon'] }}</div>
            <div class="health-tip-content">
                <strong>{{ $tip['title'] }}</strong>
                <p>{{ $tip['msg'] }}</p>
            </div>
        </div>
        @endif

        {{-- ===== DAILY HEALTH UPDATE ===== --}}
        <div class="content-card">
            <div class="card-header"><h3>📋 Daily Health Update</h3></div>
            <form action="{{ route('rekam-medis.store') }}" method="POST" class="inline-form">
                @csrf
                <div class="form-group">
                    <label>Heart Rate (Bpm)</label>
                    <input type="number" name="detak" placeholder="e.g. 80" min="30" max="200" required>
                </div>
                <div class="form-group">
                    <label>Blood Pressure</label>
                    <input type="text" name="tensi" placeholder="e.g. 120/80" required>
                </div>
                <button type="submit">Check & Save</button>
            </form>
        </div>

        {{-- ===== LOG SLEEP ===== --}}
        <div class="content-card">
            <div class="card-header">
                <h3>🛏️ Log Sleep</h3>
                <a href="{{ route('sleep.index') }}">View Details →</a>
            </div>
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

        {{-- ===== SLEEP SUMMARY ===== --}}
        @php
            $todaySleep = \App\Models\SleepRecord::where('user_id', auth()->id())
                            ->orderBy('date','desc')->first();
            $last7Days = collect();
            for ($i = 6; $i >= 0; $i--) {
                $d = now()->subDays($i)->toDateString();
                $r = \App\Models\SleepRecord::where('user_id', auth()->id())->where('date',$d)->first();
                $last7Days->push(['day'=>now()->subDays($i)->format('d'),'date'=>$d,'has_record'=>!is_null($r)]);
            }
            $sleepDuration = null;
            if ($todaySleep) {
                $s = \Carbon\Carbon::parse($todaySleep->sleep_time);
                $w = \Carbon\Carbon::parse($todaySleep->wake_time);
                if ($w->lessThan($s)) $w->addDay();
                $sleepDuration = ['hours'=>$s->diffInHours($w),'minutes'=>$s->diffInMinutes($w)%60];
            }
        @endphp

        @if($todaySleep && $sleepDuration)
        <div class="sleep-summary-card">
            <div class="sleep-time-box">
                <div class="label">Sleep time</div>
                <div class="sublabel">{{ \Carbon\Carbon::parse($todaySleep->date)->format('d M Y') }}</div>
                <div class="duration">
                    🛌 {{ $sleepDuration['hours'] }}<span>h</span> {{ $sleepDuration['minutes'] }}<span>m</span>
                </div>
                <div class="time-range">
                    {{ \Carbon\Carbon::parse($todaySleep->sleep_time)->format('g:i a') }}
                    &mdash;
                    {{ \Carbon\Carbon::parse($todaySleep->wake_time)->format('g:i a') }}
                </div>
            </div>
            <div class="sleep-consistency-box">
                <div class="label">Sleep consistency</div>
                <div class="sublabel">Target achieved {{ $last7Days->where('has_record',true)->count() }} out of 7 days</div>
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
                        <span class="date-label {{ $day['date']===now()->toDateString() ? 'today' : '' }}">{{ $day['day'] }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- ===== LATEST HISTORY ===== --}}
        <div class="content-card">
            <div class="card-header">
                <h3>📊 Latest History</h3>
                <a href="{{ route('rekam-medis') }}">View All →</a>
            </div>
            <table>
                <thead>
                    <tr><th>Date</th><th>Heart Rate</th><th>Pressure</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @forelse($history->take(5) as $item)
                        <tr>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td style="color:{{ ($item->detak>=60 && $item->detak<=100) ? '#2ecc71' : '#e74c3c' }}; font-weight:700;">
                                {{ $item->detak }} Bpm
                            </td>
                            <td>{{ $item->tensi }}</td>
                            <td><span class="status-tag {{ $item->status=='Healthy' ? 'tag-safe' : 'tag-warn' }}">{{ $item->status }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" style="text-align:center;color:#a4b0be;padding:40px;">No records yet. Start by adding your health data above!</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    @if(session('warning') || session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endif
    @if(session('warning'))
    <script>Swal.fire({icon:'warning',title:'Poor Sleep Quality',text:'{{ session("warning") }}',confirmButtonColor:'#26a69a'});</script>
    @endif
    @if(session('success'))
    <script>Swal.fire({icon:'success',title:'Saved!',text:'{{ session("success") }}',timer:2000,showConfirmButton:false});</script>
    @endif
@endsection