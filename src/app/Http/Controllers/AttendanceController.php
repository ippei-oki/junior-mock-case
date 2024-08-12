<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResisterRequest;
use App\Models\User;
use App\Models\Worktime;
use App\Models\Breaktime;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AttendanceController extends Controller
{
    public function stamp()
    {
        return view('stamp');
    }

    public function date(Request $request)
    {
        $date = $request->query('date', Carbon::today()->toDateString());
        $startOfDay = Carbon::parse($date)->startOfDay();
        $endOfDay = Carbon::parse($date)->endOfDay();
        $workTimes = WorkTime::whereBetween('work_start', [$startOfDay, $endOfDay])->paginate(5);
        return view('date', [
          'workTimes' => $workTimes,
          'date' => $date,
        ]);
    }

    public function user_list()
    {
        $users = User::Paginate(5);
        return view('user_list', ['users' => $users]);
    }

    public function user_date()
    {
        $user = Auth::user();
        $workTimes = Worktime::where('user_id', $user->id)->paginate(5);
        return view('user_date', ['workTimes' => $workTimes]);
    }

    public function work_start()
    {
        $user = Auth::user();
        $timestamp = Worktime::create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'work_start' => Carbon::now()
        ]);

        return redirect('/');
    }

    public function work_end(Request $id)
    {
        $break_conf = Breaktime::whereNull('break_end')->latest()->first();
        if ($break_conf) {
            $user = Auth::user();
            $breaktime = Breaktime::whereNotNull('work_time_id')->latest()->first();

            $break_start = Carbon::parse($breaktime->break_start);
            $break_end = Carbon::now();
            $break_duration = $break_end->diff($break_start)->format('%H:%I:%S');

            $breaktime->break_end = $break_end;
            $breaktime->break_time = $break_duration;
            $breaktime->save();

            $worktime = Worktime::whereNull('work_end')->latest()->first();
            $breaktime = new Breaktime();
            $breaktime->work_time_id = $worktime->id;
            $breaktime->break_start = Carbon::now();
            $breaktime->save();

        }

        $user = Auth::user();
        $worktime = Worktime::whereNotNull('id')->latest()->first();

        $work_start = Carbon::parse($worktime->work_start);
        $work_end = Carbon::now();
        $work_duration = $work_end->diff($work_start)->format('%H:%I:%S');
        $worktime->work_end = $work_end;
        $worktime->total_time = $work_duration;
        $worktime->save();

        $work_time_id = $worktime->id;
        $breaktimes = Breaktime::where('work_time_id', $work_time_id)->get();
        $totalSeconds = 0;
        foreach ($breaktimes as $breaktime) {
            $breakDuration = Carbon::parse($breaktime->break_time);
            $totalSeconds += $breakDuration->diffInSeconds(Carbon::today());
        }
        $totalBreakTime = gmdate('H:i:s', $totalSeconds);
        $worktime->total_break_time = $totalBreakTime;
        $worktime->save();

        $totalTime = Carbon::parse($worktime->total_time);
        $totalBreakTime = Carbon::parse($worktime->total_break_time);
        $work_time = $totalTime->diff($totalBreakTime)->format('%H:%I:%S');
        $worktime->work_time = $work_time;
        $worktime->save();

        return redirect('/');
    }

    public function break_start(Request $request)
    {
        $user = Auth::user();
        $worktime = Worktime::where('user_id', $user->id)->latest()->first();
        $work_time_id = $worktime->id;

        $breaktime = Breaktime::create([
            'work_time_id' => $work_time_id,
            'break_start' => Carbon::now()
        ]);
        
        return redirect('/');
    }

    public function break_end(Request $request)
    {
        $user = Auth::user();
        $breaktime = Breaktime::whereNotNull('work_time_id')->latest()->first();

        $break_start = Carbon::parse($breaktime->break_start);
        $break_end = Carbon::now();
        $break_duration = $break_end->diff($break_start)->format('%H:%I:%S');

        $breaktime->break_end = $break_end;
        $breaktime->break_time = $break_duration;
        $breaktime->save();

        return redirect('/');
    }

}