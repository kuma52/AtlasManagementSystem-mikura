@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-50 m-auto h-75">
    <!-- foreach($reservePersons as $reservePerson) -->
    <p><span>日</span><span class="ml-3">部</span></p>
    <!-- endforeach -->
    <div class="h-75 border">
      <table class="">
        <tr class="text-center">
          <th class="w-25">ID</th>
          <th class="w-25">名前</th>
          <th class="w-25">場所</th>
        </tr>
        <!-- foreach($reservePerson -> users as $user) -->
        <tr class="text-center">
          <td class="w-25"></td>
          <td class="w-25"></td>
          <td class="w-25"></td>
        </tr>
        <!-- endforeach -->
      </table>
    </div>
  </div>
</div>
@endsection
