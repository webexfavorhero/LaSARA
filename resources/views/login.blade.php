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
            {!! Form::open(['url' => '/branch']) !!}
                <input type="text" name="username" placeholder="Enter your name...." required=""/>
                <input type="password" name="password"  class="pass" placeholder="Password" required=""/>
                <input type="submit" value="submit">
            {!! Form::close() !!}
            <a href="#"><p>次回からオートログインする</p></a>
        </div>
        <div class="clear"> </div>
    </div>
@stop