@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css')}}">
@endsection

@section('link')
<div class="header__link">
  <a class="header__link--btn" href="/">ホーム</a>
  <a class="header__link--btn" href="/attendance">日付一覧</a>
  <form class="header__link--btn" action="/logout" method="post">
    @csrf
    <button>ログアウト</button>
  </form>
</div>
@endsection

@section('content')
<div class="stamp">
  <div class="stamp__greeting">
    @if (Auth::check())
      <h2>{{ Auth::user()->name }}さんお疲れ様です!</h2>
    @else
      <h2>ログインしてください</h2>
    @endif
  </div>
  <div class="stamp__area">
    <form action="{{ route('timestamp/work_start') }}" method="get">
      @csrf
      <button type="submit" class="stamp__btn">勤務開始</button>
    </form>
    <form action="{{ route('timestamp/work_end') }}" method="get">
      @csrf
      <button type="submit" class="stamp__btn">勤務終了</button>
    </form>
    <form action="{{ route('timestamp/break_start') }}" method="get">
      @csrf
      <button type="submit" class="stamp__btn">休憩開始</button>
    </form>
    <form action="{{ route('timestamp/break_end') }}" method="get">
      @csrf
      <button type="submit" class="stamp__btn">休憩終了</button>
    </form>
  </div>
</div>

@endsection