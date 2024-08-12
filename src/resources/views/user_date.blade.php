@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user_date.css')}}">
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
<div class="greeting">
  <h2>{{ Auth::user()->name }}さんの勤務表</h2>
</div>
<div class="date-table">
  <table>
    <tr>
      <th>日付</th>
      <th>勤務開始</th>
      <th>勤務終了</th>
      <th>休憩時間</th>
      <th>勤務時間</th>
    </tr>
    @foreach($workTimes as $workTime)
      <tr>
        <td>{{ \Carbon\Carbon::parse($workTime->work_start)->format('Y-m-d') }}</td>
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