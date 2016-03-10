@extends('basic.basic')

@section('basic-content')
    <div class="header">
        <span class="basic-header">企業管理</span>
    </div>
    {{--Register new company--}}
    <div class="register-section">
        <span class="part-header">企業エディット</span>
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
            {!! Form::open(['method' => 'PATCH', 'url' => '/basic/company/'.$company->id]) !!}
            <div class="custom-input-group">
                <a class="custom-label">営業所</a>
                <select name="office_id" id="office_id">
                    @foreach($offices as $office)
                        @if($office->id == $company->office_id)
                            <?= $selected = 'selected'; ?>
                        @else
                            <?= $selected = ''; ?>
                        @endif
                        <option value="{{ $office->id }}" {{ $selected }}>{{ $office->office_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">フリガナ</a>
                <input type="text" name="huri_company_name" placeholder="フリガナ" value="{{ $company->huri_company_name }}"/>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">企業名</a>
                <input type="text" name="company_name" placeholder="企業名" value="{{ $company->company_name }}"/>
            </div>
            <input type="submit" value="登録">
            {!! Form::close() !!}
        </div>
    </div>
    {{--Show companies--}}
    <div class="show-section">
        <span class="part-header">企業リスト</span>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="10%">
                    番号
                </th>
                <th width="10%">
                    営業所
                </th>
                <th width="45%">
                    フリガナ
                </th>
                <th width="25%">
                    企業名
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
            @foreach($companies as $company)
                <tr>
                    <td width="10%" style="text-align: center;">
                        {{ $i ++ }}
                    </td>
                    <td width="10%">
                        {{ $company->office_name }}
                    </td>
                    <td width="45%">
                        {{ $company->huri_company_name }}
                    </td>
                    <td width="25%">
                        {{ $company->company_name }}
                    </td>

                    <td width="5%" class="td-edit-cell" data-num="{{ $i }}">
                        <span class="glyphicon glyphicon-edit"></span>
                    </td>
                    <td width="5%" class="td-remove-cell" data-num="{{ $i }}">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </td>

                    <input type="hidden" name="id{{ $i }}" id="id{{ $i }}" value="{{ $company->id }}"/>
                    <input type="hidden" name="scope" id="scope" value="basic"/>
                    <input type="hidden" name="category" id="category" value="company"/>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop