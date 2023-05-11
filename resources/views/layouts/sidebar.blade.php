<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AtlasBulletinBoard</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="all_content">
  <div class="d-flex">
    <div class="sidebar">
      @section('sidebar')
      <p>
        <a href="{{ route('top.show') }}">
          <span class="i-wrapper">
            <i class="fas fa-home"></i>
            <i class="fas fa-chimney"></i>
          </span>
        <span class="item">トップ</span>
        </a>
      </p>
      <p>
        <a href="/logout">
          <span class="i-wrapper">
            <i class="fas fa-door-open"></i>
          </span>
          <span class="item">ログアウト</span>
        </a>
      </p>
      <p>
        <a href="{{ route('calendar.general.show',['user_id' => Auth::id()]) }}">
          <span class="i-wrapper">
            <i class="fas fa-calendar-alt"></i>
          </span>
          <span class="item">スクール予約</span>
        </a>
      </p>

      @if(in_array(auth()->user()->role, ['1','2','3']))
        <p>
          <a href="{{ route('calendar.admin.show',['user_id' => Auth::id()]) }}">
            <span class="i-wrapper">
              <i class="fas fa-calendar-check"></i>
            </span>
            <span class="item">スクール予約確認</span>
          </a>
        </p>
        <p>
          <a href="{{ route('calendar.admin.setting',['user_id' => Auth::id()]) }}">
            <span class="i-wrapper">
              <i class="far fa-calendar-plus"></i>
            </span>
            <span class="item">スクール枠登録</span>
          </a>
        </p>
      @endif

      <p>
        <a href="{{ route('post.show') }}">
          <span class="i-wrapper">
            <i class="far fa-comment"></i>
          </span>
          <span class="item">掲示板</span>
        </a>
      </p>
      <p>
        <a href="{{ route('user.show') }}">
          <span class="i-wrapper">
            <i class="fas fa-users"></i>
          </span>
          <span class="item">ユーザー検索</span>
        </a>
      </p>
      @show
    </div>
    <div class="main-container">
      @yield('content')
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/bulletin.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/user_search.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/calendar.js') }}" rel="stylesheet"></script>
</body>
</html>
