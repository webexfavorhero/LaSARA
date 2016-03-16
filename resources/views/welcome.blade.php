@extends('app')

@section('header')
    <h1>シャインエアー予定表</h1>
@stop

@section('content')
    <div class="mail-section content-section">
        <div class="button-section-min">
            <a href="{{ url('/business') }}" class="non-decoration"><span class="button-large">営業予定表</span></a>
        </div>
        <div class="button-section-min">
            <a href="{{ url('/construction')}}" class="non-decoration"><span class="button-large">工事予定表</span></a>
        </div>
        <div class="button-section-middle">
            <a href="{{ url('/logout')}}" class="non-decoration"><span class="button-middle">ログアウト</span></a>
        </div>
        <div class="clear"> </div>
    </div>
@stop