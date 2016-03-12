@extends('basic.basic')

@section('basic-content')
    <div class="header">
        <span class="basic-header">企業代表者管理</span>
    </div>
    {{--Register new companyman--}}
    <div class="register-section">
        <span class="part-header">代表者新登録</span>
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
            {!! Form::open(['method' => 'POST', 'url' => '/basic/companyman']) !!}
            <div class="custom-input-group">
                <a class="custom-label">営業所</a>
                <select class="office_select" name="office_id" id="office_id">
                    <option value="">- 営業所選択 -</option>
                    @foreach($offices as $office)
                        <option value="{{ $office->id }}">{{ $office->office_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">企業</a>
                <select class="company_select" name="company_id" id="company_id">
                    <option value="">- 企業選択 -</option>
                </select>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">フリガナ</a>
                <input type="text" name="huri_company_man_name" placeholder="フリガナ"/>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">代表者名</a>
                <input type="text" name="company_man_name" placeholder="代表者名"/>
            </div>
            <input type="submit" value="登録">
            {!! Form::close() !!}
        </div>
    </div>
    {{--Show companymans--}}
    <div class="show-section">
        <span class="part-header">代表者リスト</span>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="5%">
                    番号
                </th>
                <th width="10%">
                    営業所
                </th>
                <th width="20%">
                    企業
                </th>
                <th width="35%">
                    フリガナ
                </th>
                <th width="20%">
                    代表者名
                </th>
                <th width="5%">
                    編集
                </th>
                <th width="5%">
                    削除
                </th>
            </tr>
            </thead>
            <tbody>
            <span style="display: none;">{{ $i = 1 }}</span>
            @foreach($companymans as $companyman)
                <tr>
                    <td width="5%" style="text-align: center;">
                        {{ $i ++ }}
                    </td>
                    <td width="10%">
                        {{ $companyman->office_name }}
                    </td>
                    <td width="20%">
                        {{ $companyman->company_name }}
                    </td>
                    <td width="35%">
                        {{ $companyman->huri_company_man_name }}
                    </td>
                    <td width="20%">
                        {{ $companyman->company_man_name }}
                    </td>

                    <td width="5%" class="td-edit-cell" data-num="{{ $i }}" title="このアイテムを編集するためのクリック">
                        <span class="glyphicon glyphicon-edit"></span>
                    </td>
                    <td width="5%" class="td-remove-cell" data-num="{{ $i }}" title="この項目を削除する]をクリックします">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </td>

                    <input type="hidden" name="id{{ $i }}" id="id{{ $i }}" value="{{ $companyman->id }}"/>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <input type="hidden" name="scope" id="scope" value="basic"/>
    <input type="hidden" name="category" id="category" value="companyman"/>
    <input type="hidden" name="url" id="url" value="{{ URL::to('basic/companyman_companiesFromOffice') }}">
@stop