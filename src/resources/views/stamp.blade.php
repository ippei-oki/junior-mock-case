@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css')}}">
@endsection

@section('link')
<div class="header__link">
  <a class="header__link--btn" href="/">ホーム</a>
  <a class="header__link--btn" href="/attendance">日付一覧</a>
  <a class="header__link--btn" href="/logout">ログアウト</a>
</div>
@endsection

@section('content')
<div class="stamp">
  <div class="stamp__greeting">
    <h2>userさんお疲れ様です!</h2>
  </div>
  <div class="stamp__area">
    <form method="post">
    @csrf
      <div class="stamp__btn">
        <input type="submit" name="work_start" value="勤務開始">
      </div>
      <div class="stamp__btn">
        <input type="submit" name="work_end" value="勤務終了">
      </div>
      <div class="stamp__btn">
        <input type="submit" name="break_start" value="休憩開始">
      </div>
      <div class="stamp__btn">
        <input type="submit" name="break_end" value="休憩終了">
      </div>
    </form>
  </div>
</div>

@endsection