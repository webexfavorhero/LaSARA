@extends('basic.basic')

@section('basic-content')
    <div class="header">
        <span class="basic-header">項目管理</span>
    </div>
    {{--Register new item--}}
    <div class="register-section">
        <span class="part-header">項目新登録</span>
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
            {!! Form::open(['method' => 'POST', 'url' => '/basic/item']) !!}
            <div class="custom-input-group">
                <a class="custom-label">管理番号</a>
                <input type="text" name="v_index" placeholder="管理番号"/>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">フリガナ</a>
                <input type="text" name="huri_item_name" placeholder="フリガナ"/>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">項目名</a>
                <input type="text" name="item_name" placeholder="項目名"/>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">表示色</a>
                <select class="color-select" name="mark_color" id="mark_color">
                    <option value="1">黒</option>
                    <option value="2">赤</option>
                    <option value="3">青</option>
                </select>
                <a class="custom-color-label">色</a>
            </div>
            <div class="custom-input-group">
                <a class="custom-label">他項目</a>
                <select name="other_cond" id="other_cond">
                    <option value="1">編集可能にする</option>
                    <option value="0">編集不可</option>
                </select>
            </div>
            <input type="submit" value="登録">
            {!! Form::close() !!}
        </div>
    </div>
    {{--Show items--}}
    <div class="show-section">
        <span class="part-header">項目リスト</span>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="5%">
                    番号
                </th>
                <th width="10%">
                    管理番号
                </th>
                <th width="35%">
                    フリガナ
                </th>
                <th width="20%">
                    項目名
                </th>
                <th width="10%">
                    表示色
                </th>
                <th width="10%">
                    他項目
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
            @foreach($items as $item)
                <tr>
                    <td width="5%" style="text-align: center;">
                        {{ $i ++ }}
                    </td>
                    <td width="10%">
                        {{ $item->v_index }}
                    </td>
                    <td width="35%">
                        {{ $item->huri_item_name }}
                    </td>
                    <td width="20%">
                        {{ $item->item_name }}
                    </td>
                    <td width="10%" class="td-permission-cell">
                        <span class="glyphicon glyphicon-text-color" style="color: @if($item->mark_color == '1') #000000 @elseif($item->mark_color == '2') #ff0000 @elseif($item->mark_color == '3') #0000ff @endif" ></span>
                    </td>
                    <td width="10%" class="td-permission-cell">
                        <span class="glyphicon @if($item->other_cond == '1') glyphicon-star @else glyphicon-star-empty @endif"></span>
                    </td>
                    <td width="5%" class="td-edit-cell" data-num="{{ $i }}">
                        <span class="glyphicon glyphicon-edit"></span>
                    </td>
                    <td width="5%" class="td-remove-cell" data-num="{{ $i }}">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </td>

                    <input type="hidden" name="id{{ $i }}" id="id{{ $i }}" value="{{ $item->id }}"/>
                    <input type="hidden" name="scope" id="scope" value="basic"/>
                    <input type="hidden" name="category" id="category" value="item"/>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop