<?php
namespace App\Calendars\General;

use App\Calendars\General\CalendarWeekDay;//足した

class CalendarWeekBlankDay extends CalendarWeekDay{
  function getClassName(){
    return "day-blank";
  }

  /**
   * @return
   */

   function render(){
     return '';
   }

   function selectPart($ymd){
     return '';
   }

   function getDate(){
     return '';
   }

   function cancelBtn(){
     return '';
   }

   function everyDay(){
     return '';
   }

}
