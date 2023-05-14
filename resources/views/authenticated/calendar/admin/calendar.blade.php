@extends('layouts.sidebar')

@section('content')
<div class="w-75 m-auto pt-5">
  <div class="reserve_check pt-3 pb-3 shadow">
    <p class="text-center">{{ $calendar->getTitle() }}</p>
    <div>
      {!! $calendar->render() !!}
    </div>
  </div>
</div>
@endsection
