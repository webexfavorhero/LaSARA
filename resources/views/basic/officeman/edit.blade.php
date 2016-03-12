@extends('basic.basic')

@section('basic-content')
    <div class="header">
        <span class="basic-header">営業所担当者管理</span>
    </div>
    {{--Update officeman--}}
    <div class="register-section">
        <span class="part-header">担当者エディット</span>
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
            {!! Form::open(['method' => 'PATCH', 'url' => '/basic/officeman/'.$officeman->id]) !!}
            <div class="custom-input-group">
                <a class="custom-label">コード</a>
                <input type="text" name="code" placeholder="コード" value="{{ $officeman->code }}"/>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">フリガナ</a>
                <input type="text" name="huri_office_man_name" placeholder="フリガナ" value="{{ $officeman->huri_office_man_name }}"/>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">氏名</a>
                <input type="text" name="office_man_name" placeholder="氏名" value="{{ $officeman->office_man_name }}"/>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">営業所</a>
                <select name="office_id" id="office_id">
                    @foreach($offices as $office)
                        @if($office->id == $officeman->office_id)
                            <?= $selected = 'selected'; ?>
                        @else
                            <?= $selected = ''; ?>
                        @endif
                        <option value="{{ $office->id }}" {{ $selected }}>{{ $office->office_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">表示順</a>
                <input type="text" name="v_index" placeholder="表示順" value="{{ $officeman->v_index }}"/>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">表示</a>
                <select name="v_status" id="v_status">
                    <option value="1" @if($officeman->v_status == '1') selected @endif>表示する</option>
                    <option value="0" @if($officeman->v_status == '0') selected @endif>非表示</option>
                </select>
            </div>
            <input type="submit" value="登録">
            {!! Form::close() !!}
        </div>
    </div>
    {{--Show officemans--}}
    <div class="show-section">
        <span class="part-header">担当者リスト</span>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="5%">
                    番号
                </th>
                <th width="7%">
                    コード
                </th>
                <th width="36%">
                    フリガナ
                </th>
                <th width="20%">
                    氏名
                </th>
                <th width="10%">
                    営業所
                </th>
                <th width="7%">
                    表示順
                </th>
                <th width="5%">
                    表示
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
            @foreach($officemans as $officeman)
                <tr>
                    <td width="5%" style="text-align: center;">
                        {{ $i ++ }}
                    </td>
                    <td width="7%">
                        {{ $officeman->code }}
                    </td>
                    <td width="36%">
                        {{ $officeman->huri_office_man_name }}
                    </td>
                    <td width="20%">
                        {{ $officeman->office_man_name }}
                    </td>
                    <td width="10%">
                        {{ $officeman->office_name }}
                    </td>
                    <td width="7%">
                        {{ $officeman->v_index }}
                    </td>
                    <td width="5%" class="td-permission-cell">
                        <span class="glyphicon @if($officeman->v_status == '1') glyphicon-star @else glyphicon-star-empty @endif"></span>
                    </td>
                    <td width="5%" class="td-edit-cell" data-num="{{ $i }}" title="このアイテムを編集するためのクリック">
                        <span class="glyphicon glyphicon-edit"></span>
                    </td>
                    <td width="5%" class="td-remove-cell" data-num="{{ $i }}" title="この項目を削除する]をクリックします">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </td>

                    <input type="hidden" name="id{{ $i }}" id="id{{ $i }}" value="{{ $officeman->id }}"/>
                    <input type="hidden" name="scope" id="scope" value="basic"/>
                    <input type="hidden" name="category" id="category" value="officeman"/>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop