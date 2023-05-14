@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-50 m-auto h-75">
    <p><span>{{ $date }}日</span><span class="ml-3">{{ $part }}部</span></p>
    <div class="shadow bg-w p-2 br-7">
      <table class="reserve_detail">
        <tr class="text-center">
          <th class="w-25">ID</th>
          <th class="w-25">名前</th>
          <th class="w-25">場所</th>
        </tr>
        @foreach($reservePersons as $reservePerson)
          @foreach($reservePerson -> users as $user)
            <tr class="text-center">
              <td class="w-25">{{ $user->id }}</td>
              <td class="w-25"><span>{{ $user->over_name }}　</span><span>{{ $user->under_name }}</span></td>
              <td class="w-25">リモート</td>
            </tr>
          @endforeach
        @endforeach
      </table>
    </div>
  </div>
</div>
@endsection
