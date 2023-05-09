<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;//どこにある？
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request){
        DB::beginTransaction();
        // dd($request);
        try{
            $getPart = $request->getPart;
            $getDate = $request->getData;
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }


    public function delete(Request $request){
        //受け取った値を変数に代入
        $setting_part = $request->int_part;
        $setting_reserve = $request->int_day;
        //reserve_settingsテーブルから、$setting_partと$setting_reserveが一致するレコードを一つ検索
        $reserve_settings = ReserveSettings::where('setting_part', $setting_part)->where('setting_reserve', $setting_reserve)->first();
        //制限人数を1増やす
        $reserve_settings->increment('limit_users');
        //$reserve_settingsのusersリレーションに対してdetachメソッドを呼び出してレコードを削除
        $reserve_settings->users()->detach(Auth::id());
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }
}
