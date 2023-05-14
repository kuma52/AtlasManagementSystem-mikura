@extends('layouts.sidebar')

@section('content')
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="w-75 m-auto p-3 shadow" style="border-radius:5px; background:#FFF;">
    <div class="w-auto m-auto" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="border mb-3">
        {!! $calendar->render() !!}
        <!-- CalendarView.phpに記述のコードが呼び出される -->
      </div>
      <div class="text-right w-75 m-auto mt-1">
        <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
      </div>
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
          <input type="hidden" name="int_day" class="modal-int-day" value="" form="deleteParts">
          <input type="hidden" name="int_part" class="modal-int-part" value="" form="deleteParts">
          <form action="/delete/calendar" form="deleteParts" method="post"></form>
          <div class="d-flex justify-content-around">
            <button class="modal-close btn btn-primary p-1 w-25">閉じる</button>
            <button class="btn btn-danger p-1 w-25" style="font-size:12px" form="deleteParts">キャンセル</button>
          </div>
  </div>
</div>

@endsection
