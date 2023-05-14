@extends('layouts.sidebar')

@section('content')
<div class="search_content w-100 d-flex">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="border one_person shadow">
      <div>
        <span class="text-muted">ID : </span><span class="font-weight-bold">{{ $user->id }}</span>
      </div>
      <div>
        <span class="text-muted">名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span class="font-weight-bold">{{ $user->over_name }}</span>
          <span class="font-weight-bold text-primary">{{ $user->under_name }}</span>
        </a>
      </div>
      <div>
        <span class="text-muted">カナ : </span>
        <span class="font-weight-bold">({{ $user->over_name_kana }}</span>
        <span class="font-weight-bold">{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span class="text-muted">性別 : </span><span class="font-weight-bold">男</span>
        @else
        <span class="text-muted">性別 : </span><span class="font-weight-bold">女</span>
        @endif
      </div>
      <div>
        <span class="text-muted">生年月日 : </span><span class="font-weight-bold">{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span class="text-muted">権限 : </span><span class="font-weight-bold">教師(国語)</span>
        @elseif($user->role == 2)
        <span class="text-muted">権限 : </span><span class="font-weight-bold">教師(数学)</span>
        @elseif($user->role == 3)
        <span class="text-muted">権限 : </span><span class="font-weight-bold">講師(英語)</span>
        @else
        <span class="text-muted">権限 : </span><span class="font-weight-bold">生徒</span>
        @endif
      </div>
      <div>
        @if($user->role == 4)
        <span class="text-muted">選択科目 :
          @foreach($user->subjects as $subject)
            {{ $subject->subject }}
        @endforeach
        </span>
        @endif
      </div>
    </div>
    @endforeach
  </div>

  <!-- 検索ボード -->
  <div class="search_area w-25 mt-5 ml-3">
    <div class="">
      <div>
        <p>検索</p>
        <input type="text" class="free_word user_search" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <div class="mt-3">
        <lavel>カテゴリ</lavel>
        <select class="user_search d-block pointer" form="userSearchRequest" name="category">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div>
        <label class="mt-3">並び替え</label>
        <select class="user_search d-block w-70 pointer" name="updown" form="userSearchRequest">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>

      <div class="mt-3">
        <p class="m-0 search_conditions line"><span>検索条件の追加</span><span class="arrow"></span></p>
        <div class="search_conditions_inner">
          <div>
            <label class="mb-0">性別</label>
            <div>
              <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
              <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
            </div>
          </div>
          <div>
            <label class="mt-3 mb-0">権限</label>
            <select name="role" form="userSearchRequest" class="engineer user_search d-block">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <div class="selected_engineer">
            <label class="mt-3 mb-1">選択科目</label>
            <div class="d-flex mb-4">
              @foreach($subjects as $subject)
                <input type="checkbox" name="subject[]" value="{{ $subject->id }}" form="userSearchRequest"  class="margin">
                  <label class="mb-0">{{ $subject->subject }}</label>
                </input>
              @endforeach
              </div>
          </div>
        </div>
      </div>
      <div class="search_btn_wrapper">
        <input type="submit" class="btn search_btn" name="search_btn" value="検索" form="userSearchRequest">
      </div>
      <div class="w-200 reset mt-2">
        <input type="reset" value="リセット" form="userSearchRequest" class="btn ">
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest" form="userSearchRequest"></form>
  </div>
</div>
@endsection
