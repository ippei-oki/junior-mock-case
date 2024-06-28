<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResisterRequest;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Worktime;
use App\Models\Breaktime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function stamp()
    {
        return view('stamp');
    }

    public function work_start()
    {
        $user = Auth::user();
        $timestamp = Worktime::create([
            'user_id' => $user->id,
            'work_start' => Carbon::now()
        ]);
        return redirect('/');
    }

    public function work_end(Request $id)
    {
        $user = Auth::user();
        $timestamp = Worktime::create([
            'user_id' => $user->id,
            'work_end' => Carbon::now()
        ]);

        $worktime = Worktime::whereNotNull('work_start')->first();
        $startTime = Carbon::parse($worktime->work_start);
        $worktime = Worktime::whereNotNull('work_end')->first();
        $endTime = Carbon::parse($worktime->work_end);
        $worktime->work_time = $startTime->diff($endTime)->format('%H:%I:%S');
        $worktime->save();

        return redirect('/');
    }

    public function break_start()
    {
        $user = Auth::user();
        $timestamp = Worktime::create([
            'user_id' => $user->id,
            'break_start' => Carbon::now()
        ]);
        return redirect('/');
    }

    public function break_end()
    {
        $user = Auth::user();
        $timestamp = Worktime::create([
            'user_id' => $user->id,
            'break_end' => Carbon::now()
        ]);

        $breaktime = Worktime::whereNotNull('break_start')->first();
        $breakstartTime = Carbon::parse($breaktime->break_start);
        $breaktime = Worktime::whereNotNull('break_end')->first();
        $breakendTime = Carbon::parse($breaktime->break_end);
        $breaktime->break_time = $breakstartTime->diff($breakendTime)->format('%H:%I:%S');
        $breaktime->save();

        return redirect('/');
    }
}
