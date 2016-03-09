@extends('app')

@section('header')
    <div class="basic-top">
        <h1>管理者パネル</h1>
    </div>
@stop

@section('content')
    @include('basic.menu')
    @yield('basic-content')
@stop