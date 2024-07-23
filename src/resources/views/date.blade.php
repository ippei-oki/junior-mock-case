@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css')}}">
@endsection

@section('link')
<div class="header__link">
  <a class="header__link--btn" href="/">ホーム</a>
  <a class="header__link--btn" href="/attendance">日付一覧</a>
  <div style="display:inline-flex">
    <form class="header__link--btn" action="/logout" method="post">
      @csrf
      <button>ログアウト</button>
    </form>
  </div>
</div>
@endsection

@section('content')
<div class="date-select">
  <a class="date-select__btn" href="{{ url('/work-times?date=' . \Carbon\Carbon::parse($date)->subDay()->toDateString()) }}">&lt;</a>
  <span class="date-select__txt">{{ $date }}</span>
  <a class="date-select__btn" href="{{ url('/work-times?date=' . \Carbon\Carbon::parse($date)->addDay()->toDateString()) }}">&gt;</a>
</div>
<div class="date-table">
  <table>
    <tr>
      <th>名前</th>
      <th>勤務開始</th>
      <th>勤務終了</th>
      <th>休憩時間</th>
      <th>勤務時間</th>
    </tr>
    @foreach($workTimes as $workTime)
      <tr>
        <td>{{ $workTime->user_name }}</td>
        <td>{{ \Carbon\Carbon::parse($workTime->work_start)->format('H:i:s') }}</td>
        <td>{{ \Carbon\Carbon::parse($workTime->work_end)->format('H:i:s') }}</td>
        <td>{{ $workTime->total_break_time }}</td>
        <td>{{ $workTime->work_time }}</td>
      </tr>
    @endforeach
  </table>
</div>
<div class="paginate">
  {{ $workTimes->appends(request()->query())->links() }}
</div>
@endsection