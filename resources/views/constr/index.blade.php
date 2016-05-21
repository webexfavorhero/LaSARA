@extends('app')

@section('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    {{--Semantic UI--}}
    {!! Html::style('assets/css/semantic.min.css') !!}
@stop

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    {{--Semantic UI--}}
    <script src="{!! asset('assets/js/semantic.min.js') !!}"></script>
    <script>
        $(document).ready(function(){
            $('input[name="cons_cal"]').click(function(){
                var num;
                num = $(this).attr('data-num');
                $('#' + num).modal('show');
            });
        })
    </script>
@stop

@section('content')
    <section style="padding: 30px;">
        <div class="ui menu">
            @foreach($offices as $k => $office)
                <a class="item @if($office->id == $office_id) active @endif" href="{{ URL::to('construction?office_id=' . $office->id) }}">{{ $office->office_name }}</a>
            @endforeach
            <div class="right menu">
                <a class="item" href="{{ URL::to('branch') }}">メインメニュー</a>
                <a class="item" href="{{ URL::to('logout') }}">ログアウト</a>
            </div>
        </div>
    </section>
    <section id="construction-calendar">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>
                    {{ $year }}年
                </th>
                @foreach($company_mans as $company_man)
                    <th>
                        {{ $company_man->company_name }}
                    </th>
                @endforeach
            </tr>
            <tr>
                <th>
                    {{ $month }}月
                </th>
                @foreach($company_mans as $company_man)
                    <th>
                        {{ $company_man->company_man_name }}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @for($i = 1; $i < $days + 1; $i ++)
                <tr>
                    <td class="vertical-align-td" constant_width="date">
                        {{ $i }}
                    </td>
                    @foreach($company_mans as $company_man)
                        <td>
                            <table class="table deep-3-table">
                                <?php
                                $cons_cals = \App\ConstructionCalendar::where('company_man_id', $company_man->id)
                                        ->where('main_date', \Carbon\Carbon::createFromFormat('Y-m-d', $year . "-" . $month . "-" . $i)->toDateString())
                                        ->get();
                                ?>
                                @foreach($cons_cals as $j => $cons_cal)
                                    @if($j < 3)
                                        <tr>
                                            <td class="col-sm-12 @if($j == 2) border-black-3-td @elseif($j == 1) border-black-2-td @else border-black-1-td @endif">
                                                <input type="text" class="col-lg-12" name="cons_cal" data-num="{{ $company_man->id }}day{{ $i }}row{{ $j }}"
                                                       style="background-color: @if($cons_cal->back_color == 1) #ffffff @elseif($cons_cal->back_color == 2) #ccffcc @elseif($cons_cal->back_color == 3) #ccffff @elseif($cons_cal->back_color == 4) #99ccff @endif ; color: @if($cons_cal->char_color == 1) #000000 @elseif($cons_cal->char_color == 2) #0000ff @elseif($cons_cal->char_color == 3) #ff0000 @endif ; "
                                                       value="{{ $cons_cal->field_name }}" readonly />
                                                {{-- Modal --}}
                                                @if($auth == "manager" || $auth == "edit_user")
                                                <div class="ui small modal" style="height: 780px;" id="{{ $company_man->id }}day{{ $i }}row{{ $j }}">
                                                    <div class="header" style="background-color: #0000ff; color: #ffffff;">
                                                        現　場　登　録
                                                    </div>
                                                    {!! Form::open(['method' => 'PATCH', 'class' => 'ui fluid form', 'url' => URL::to('construction/' . $cons_cal->id)]) !!}
                                                    <div class="image content" style="padding: 30px;">
                                                        <div class="description">
                                                            <div class="ui header">プランバー</div>
                                                            <div class="ui header">{{ $company_man->company_man_name }}</div>
                                                            <div class="field" placeholder="現場名">
                                                                <div class="ui pointing below label">
                                                                    現場名
                                                                </div>
                                                                <input type="text" name="field_name" id="field_name" value="{{ $cons_cal->field_name }}" >
                                                            </div>
                                                            <div class="field" placeholder="文字色">
                                                                <div class="ui pointing below label">
                                                                    文字色
                                                                </div>
                                                                <select class="ui dropdown" name="char_color" id="char_color" style="background-color: @if($cons_cal->char_color == 1) #000000 @elseif($cons_cal->char_color == 2) #0000ff @elseif($cons_cal->char_color == 3) #ff0000 @endif ;" onchange="this.style.background=this.options[this.selectedIndex].style.background">
                                                                    <option value="1" style="background: #000000; color: #000000;" @if($cons_cal->char_color == 1) selected @endif>黒</option>
                                                                    <option value="2" style="background: #0000ff; color: #0000ff;" @if($cons_cal->char_color == 2) selected @endif>青</option>
                                                                    <option value="3" style="background: #ff0000; color: #ff0000;" @if($cons_cal->char_color == 3) selected @endif>赤</option>
                                                                </select>
                                                            </div>
                                                            <div class="field" placeholder="内容">
                                                                <div class="ui pointing below label">
                                                                    内容
                                                                </div>
                                                                <input type="text" name="content" id="content" value="{{ $cons_cal->content }}" >
                                                            </div>
                                                            <div class="field" placeholder="背景色の変更">
                                                                <div class="ui pointing below label">
                                                                    背景色の変更
                                                                </div>
                                                                <select class="ui dropdown" name="back_color" id="back_color" style="background-color: @if($cons_cal->back_color == 1) #ffffff @elseif($cons_cal->back_color == 2) #ccffcc @elseif($cons_cal->back_color == 3) #ccffff @elseif($cons_cal->back_color == 4) #99ccff @endif ;" onchange="this.style.background=this.options[this.selectedIndex].style.background">
                                                                    <option value="1" style="background: #ffffff; color: #ffffff;" @if($cons_cal->back_color == 1) selected @endif>なし</option>
                                                                    <option value="2" style="background: #ccffcc; color: #ccffcc;" @if($cons_cal->back_color == 2) selected @endif>引上</option>
                                                                    <option value="3" style="background: #ccffff; color: #ccffff;" @if($cons_cal->back_color == 3) selected @endif>ユニック吊替</option>
                                                                    <option value="4" style="background: #99ccff; color: #99ccff;" @if($cons_cal->back_color == 4) selected @endif>休業日など</option>
                                                                </select>
                                                            </div>
                                                            <p>
                                                                工事日：{{ $year }}年 {{ $month }}月 {{ $i }}日
                                                            </p>
                                                            <div class="inline field">
                                                                <div class="ui right pointing label">
                                                                    開始時間
                                                                </div>
                                                                <input type="time" name="start_time" id="start_time" value="{{ $cons_cal->start_time }}">
                                                            </div>
                                                            <div class="inline field">
                                                                <div class="ui right pointing label">
                                                                    発注金額
                                                                </div>
                                                                <input type="text" name="order_amount" id="order_amount" value="{{ $cons_cal->order_amount }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="office_id"      id="office_id"      value="{{ $office_id }}">
                                                    <input type="hidden" name="company_id"     id="company_id"     value="{{ $company_man->company_id }}">
                                                    <input type="hidden" name="company_man_id" id="company_man_id" value="{{ $company_man->id }}">
                                                    <input type="hidden" name="main_date"      id="main_date"      value="<?= \Carbon\Carbon::createFromFormat('Y-m-d', $year . "-" . $month . "-" . $i)->toDateString(); ?>">
                                                    <input type="hidden" name="cell_id"        id="cell_id"        value="{{ $j + 1 }}">
                                                    <div class="actions" style="padding: 30px;">
                                                        <div class="ui black deny button">
                                                            いいえ
                                                        </div>
                                                        <input type="submit" class="ui primary button" value="登録">
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                                @elseif($auth == "comm_user")
                                                <div class="ui small modal" style="height: 250px;" id="{{ $company_man->id }}day{{ $i }}row{{ $j }}">
                                                    <i class="close icon"></i>
                                                    <div class="header" style="background-color: #f4cace; color: #FF0000;">
                                                        警告
                                                    </div>
                                                    <div class="image content">
                                                        <div class="description">
                                                            <div class="ui header">制限された認証</div>
                                                            <p>あなたの権限では編集できません。</p>
                                                        </div>
                                                    </div>
                                                    <div class="actions">
                                                        <div class="ui positive right labeled icon button">
                                                            はい
                                                            <i class="checkmark icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </td>
                    @endforeach
                </tr>
            @endfor
            </tbody>
        </table>
    </section>
@stop