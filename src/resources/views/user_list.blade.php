@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user_list.css')}}">
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
<div class="user-table">
  <table>
    <tr>
      <th>名前</th>
      <th>メール</th>
    </tr>
    @foreach($users as $user)
      <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
      </tr>
    @endforeach
  </table>
</div>
<div class="paginate">
  {{ $users->appends(request()->query())->links() }}
</div>
@endsection