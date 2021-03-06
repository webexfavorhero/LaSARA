@extends('basic.basic')

@section('basic-content')
    <div class="header">
        <span class="basic-header">ユーザー管理</span>
    </div>
    {{--Register user--}}
    <div class="register-section">
        <span class="part-header">ユーザー新登録</span>
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
            <div class="custom-input-group">
                <a class="custom-label">ユーザー名</a>
                <input type="text" name="username" placeholder="ユーザー名"/>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">パスワード</a>
                <input type="password" name="password" placeholder="パスワード"/>
            </div>
            <input type="checkbox" name="permissionCheck" id="permissionCheck" class="checkbox"><span class="checkbox-label">編集可能な権限</span>
            <input type="hidden" name="permission" id="permission" value="0"/>
            <input type="submit" value="登録">
            {!! Form::close() !!}
        </div>
    </div>
    {{--Show users--}}
    <div class="show-section">
        <span class="part-header">ユーザーリスト</span>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="10%">
                        番号
                    </th>
                    <th width="30%">
                        ユーザー
                    </th>
                    <th width="30%">
                        パスワード
                    </th>
                    <th width="10%">
                        許可
                    </th>
                    <th width="10%">
                        編集
                    </th>
                    <th width="10%">
                        削除
                    </th>
                </tr>
            </thead>
            <tbody>
                <span style="display: none;">{{ $i = 1 }}</span>
                @foreach($users as $user)
                <tr>
                    <td width="10%" style="text-align: center;">
                        {{ $i ++ }}
                    </td>
                    <td width="30%">
                        {{ $user->username }}
                    </td>
                    <td width="30%">
                        {{ $user->password }}
                    </td>
                    <td width="10%" class="td-permission-cell">
                        <span class="glyphicon @if($user->permission == '1') glyphicon-star @else glyphicon-star-empty @endif"></span>
                    </td>
                    <td width="10%" class="td-edit-cell" data-num="{{ $i }}" title="このアイテムを編集するためのクリック">
                        <span class="glyphicon glyphicon-edit"></span>
                    </td>
                    <td width="10%" class="td-remove-cell" data-num="{{ $i }}" title="この項目を削除する]をクリックします">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </td>

                    <input type="hidden" name="id{{ $i }}" id="id{{ $i }}" value="{{ $user->id }}"/>
                    <input type="hidden" name="scope" id="scope" value="basic"/>
                    <input type="hidden" name="category" id="category" value="user"/>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop