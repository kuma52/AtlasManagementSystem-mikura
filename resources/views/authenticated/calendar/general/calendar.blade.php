@extends('layouts.sidebar')

@section('content')
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto border" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
        <!-- CalendarView.phpに記述のコードが呼び出される -->
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>

<!-- モーダル中身 -->
<!-- calendarViewにも書けるけどbladeのほうが煩雑にならないからこっちに書く -->
<div class="modal" id="cancelModal">
  <div class="modal__bg"></div>
  <div class="modal__content">
          <div>予約日：<span class="modal-day"></span></div>
          <div>時間：<span class="modal-string-part"></span></div>
          <p>上記の予約をキャンセルしてもよろしいですか？</p>
          <input type="hidden" name="id" class="modal-id" value="" form="deleteParts">
          <input type="hidden" name="int_part" class="modal-int-part" value="" form="deleteParts">
          <form action="/delete/calendar" form="deleteParts" method="post"></form>
          <button class="modal-close btn btn-primary p-0 w-75">閉じる</button>
          <button class="btn btn-danger p-0 w-75" style="font-size:12px" form="deleteParts">キャンセル</button>
  </div>
</div>

@endsection
