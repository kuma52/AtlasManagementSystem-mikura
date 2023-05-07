<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;
use App\Calendars\General\CalendarWeek;//足した下記2行とともに
use App\Calendars\General\CalendarWeekBlankDay;
use App\Calendars\General\CalendarWeekDay;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';

      $days = $week->getDays();
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = $this->carbon->copy()->format("Y-m-d");

        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<td class="calendar-td '.$day->pastClassName().'">';
        }else{
          $html[] = '<td class="calendar-td '.$day->getClassName().'">';
        };
        $html[] = $day->render();

        //予約をしている場合
        if(in_array($day->everyDay(), $day->authReserveDay())){
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart = "リモ1部";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
          }
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){//過去
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">'. $reservePart .'参加</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{//未来
            $html[] = '<button type="submit" class="modal-open btn btn-danger p-0 w-75" name="delete_date" style="font-size:12px" data-bs-target="#cancelModal" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'">'. $reservePart .'</button>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="deleteParts">';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }
        }else{//予約していない場合
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){//過去
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">受付終了</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{//未来
          $html[] = $day->selectPart($day->everyDay());
          }
        }
        $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';

    // 予約キャンセルのモーダル->calenderViewだと見づらい書きづらいからcalendar.bladeに書く
    // $html[] = '<div class="modal" id="cancelModal">';
    // $html[] = '<div class="modal__bg"></div>';
    // $html[] = '<div class="modal__content">';
    // $html[] = '<p>ファサードとかでモーダルに引っ張った日時を表示</p>';
    // $html[] = '<p class=".modal-part"></p>';
    // $html[] = '<p>上記の予約をキャンセルしてもよろしいですか？</p>';
    // $html[] = '<input type="hidden" name="id" value="" form="deleteParts">';
    // $html[] = '<form action="/delete/calendar" form="deleteParts" method="post"></form>';
    // $html[] = '<button class="modal-close btn btn-primary p-0 w-75">閉じる</button>';
    // $html[] = '<button class="btn btn-danger p-0 w-75" name="delete_date" style="font-size:12px" form="deleteParts">キャンセル</button>';
    // // $html[] = '';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';
    $html[] = '</div>';

    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
