@extends('_layout.default')
@section('title', $user->name)
@section('content')
<div class="offset-md-2 col-md-8">
  <div class="panel panel-default mt-5">
    <div class="panel-heading mb-3">
    <h4>欢迎您 {{ $user->name }}</h4>
    </div>
  </div>
</div>
@stop
