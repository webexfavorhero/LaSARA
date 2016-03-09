@extends('app')

@section('header')
    <h1>シャインエアー予定表</h1>
@stop

@section('content')
    <div class="mail-section">
        <div class="close"> </div>
        <div class="mail-image">
            <img src="assets/images/message.png" alt="" />
            <h3>ようこそ</h3>
            <h2>シャインエアー</h2>
        </div>
        <div class="mail-form">
            {{-- Error Message --}}
            @if (Session::has('error'))
                <div class="error">{{ Session::get('error') }}</div>
            @endif

            {!! Form::open(['url' => '/branch']) !!}
                <input type="text" name="username" placeholder="ユーザー名" required=""/>
                <input type="password" name="password"  class="pass" placeholder="パスワード" required=""/>
                <input type="submit" value="提出する">
            {!! Form::close() !!}
            <a href="#" style="text-decoration: none !important;"><p>次回からオートログインする</p></a>
        </div>
        <div class="clear"> </div>
    </div>
@stop