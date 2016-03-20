@extends('layouts.default')

@section('title')
{{{ $user->name }}} {{ lang('Basic Info') }}_@parent
@stop

@section('content')

@include('usersinfo.left')
@include('usersinfo.right_userinfo')
@stop
