<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SleepRecord;
use Carbon\Carbon;

class SleepController extends Controller
{
    public function index()
    {
        $records = SleepRecord::where('user_id', auth()->id())
                              ->orderBy('date', 'desc')
                              ->get();

        $last7Days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date   = now()->subDays($i)->toDateString();
            $record = $records->firstWhere('date', $date);
            $last7Days->push([
                'day'        => now()->subDays($i)->format('d'),
                'date'       => $date,
                'sleep_time' => $record?->sleep_time,
                'wake_time'  => $record?->wake_time,
                'duration'   => $record ? $this->calcDuration($record->sleep_time, $record->wake_time) : null,
                'has_record' => !is_null($record),
            ]);
        }

        $latest         = $records->first();
        $latestDuration = $latest ? $this->calcDuration($latest->sleep_time, $latest->wake_time) : null;

        return view('sleep.sleep_index', compact('records', 'last7Days', 'latest', 'latestDuration'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'       => 'required|date|before_or_equal:today',
            'sleep_time' => 'required',
            'wake_time'  => 'required',
        ]);

        $sleepTime = Carbon::parse($request->sleep_time);

        $warning = null;
        if ($sleepTime->hour >= 23 || $sleepTime->hour < 5) {
            $warning = "Warning: Sleeping after midnight may result in poor sleep quality.";
        }

        // Jika tanggal sudah ada, update — kalau belum, buat baru
        $existing = SleepRecord::where('user_id', auth()->id())
                        ->where('date', $request->date)
                        ->first();

        if ($existing) {
            $existing->update([
                'sleep_time' => $request->sleep_time,
                'wake_time'  => $request->wake_time,
            ]);
        } else {
            SleepRecord::create([
                'user_id'    => auth()->id(),
                'sleep_time' => $request->sleep_time,
                'wake_time'  => $request->wake_time,
                'date'       => $request->date,
            ]);
        }

        $formattedDate = Carbon::parse($request->date)->format('d M Y');

        return redirect()->back()->with([
            'success' => "Sleep record saved for {$formattedDate}!",
            'warning' => $warning,
        ]);
    }

    private function calcDuration($sleepTime, $wakeTime)
    {
        $sleep = Carbon::parse($sleepTime);
        $wake  = Carbon::parse($wakeTime);

        if ($wake->lessThan($sleep)) {
            $wake->addDay();
        }

        return [
            'hours'   => $sleep->diffInHours($wake),
            'minutes' => $sleep->diffInMinutes($wake) % 60,
        ];
    }
}