@extends('basic.layout1')

@section('basic-content')
    <div class="header">
        <span class="basic-header">ユーザー管理</span>
    </div>
    <div class="register-section">
        <span class="part-header">ユーザー登録</span>
        <div class="register-form">
            {{-- Error Message --}}
            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            {!! Form::open(['url' => '/basic/user']) !!}
            <input type="text" name="username" placeholder="ユーザー名"/>
            <input type="password" name="password"  class="pass" placeholder="パスワード"/>
            <input type="checkbox" name="permissionCheck" id="permissionCheck" class="checkbox"><span class="checkbox-label">編集可能な権限</span>
            <input type="hidden" name="permission" id="permission" value="0"/>
            <input type="submit" value="登録">
            {!! Form::close() !!}
        </div>
    </div>
    <div class="show-section">
        <span class="part-header">ユーザー登録</span>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>
                        1
                    </th>
                    <th>
                        2
                    </th>
                    <th>
                        3
                    </th>
                    <th>
                        4
                    </th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    qq
                </td>
                <td>
                    ww
                </td>
                <td>
                    ee
                </td>
                <td>
                    rr
                </td>
            </tr>
            <tr>
                <td>
                    aa
                </td>
                <td>
                    ss
                </td>
                <td>
                    dd
                </td>
                <td>
                    ff
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@stop