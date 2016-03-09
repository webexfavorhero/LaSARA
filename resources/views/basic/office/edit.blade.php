@extends('basic.basic')

@section('basic-content')
    <div class="header">
        <span class="basic-header">営業所管理</span>
    </div>
    {{--Register user--}}
    <div class="register-section">
        <span class="part-header">営業所エディット</span>
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
            {!! Form::open(['method' => 'PATCH', 'url' => '/basic/office/' . $office->id]) !!}
            <div class="custom-input-group">
                <a class="custom-label">管理番号</a>
                <input type="text" name="v_index" placeholder="管理番号" value="{{ $office->v_index }}"/>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">フリガナ</a>
                <input type="text" name="huri_office_name" placeholder="フリガナ" value="{{ $office->huri_office_name }}"/>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">営業所名</a>
                <input type="text" name="office_name" placeholder="営業所名" value="{{ $office->office_name }}"/>
            </div>
            <input type="submit" value="更新">
            {!! Form::close() !!}
        </div>
    </div>
    {{--Show users--}}
    <div class="show-section">
        <span class="part-header">営業所リスト</span>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="10%">
                    番号
                </th>
                <th width="10%">
                    管理番号
                </th>
                <th width="30%">
                    フリガナ
                </th>
                <th width="30%">
                    営業所名
                </th>
                <th width="10%">
                    エディット
                </th>
                <th width="10%">
                    デリート
                </th>
            </tr>
            </thead>
            <tbody>
            <span style="display: none;">{{ $i = 1 }}</span>
            @foreach($offices as $office)
                <tr>
                    <td width="10%" style="text-align: center;">
                        {{ $i ++ }}
                    </td>
                    <td width="10%">
                        {{ $office->v_index }}
                    </td>
                    <td width="30%">
                        {{ $office->huri_office_name }}
                    </td>
                    <td width="30%">
                        {{ $office->office_name }}
                    </td>
                    <td width="10%" class="td-edit-cell" data-num="{{ $i }}">
                        <span class="glyphicon glyphicon-edit"></span>
                    </td>
                    <td width="10%" class="td-remove-cell" data-num="{{ $i }}">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </td>

                    <input type="hidden" name="id{{ $i }}" id="id{{ $i }}" value="{{ $office->id }}"/>
                    <input type="hidden" name="scope" id="scope" value="basic"/>
                    <input type="hidden" name="category" id="category" value="office"/>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop