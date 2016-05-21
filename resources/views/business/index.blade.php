@extends('app')

@section('styles')
    {{-- Date Picker Css--}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@stop
@section('scripts')
    {{-- Date Picker Js --}}
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script>
        $(function() {
            $( "#startDate" ).datepicker({
                defaultDate: "+1w",
                changeMonth: false,
                numberOfMonths: 1,
                onClose: function( selectedDate ) {
                    $( "#endDate" ).datepicker( "option", "minDate", selectedDate );
                }
            });
            $( "#endDate" ).datepicker({
                defaultDate: "+1w",
                changeMonth: false,
                numberOfMonths: 1,
                onClose: function( selectedDate ) {
                    $( "#startDate" ).datepicker("option", "maxDate", selectedDate );
                }
            });
        });
    </script>
@stop

@section('content')
    {{-- Search Section --}}
    <section id="search">
        <div class="col-lg-7 col-md-8 col-sm-8 col-xs-8  search-form">
            {!! Form::open(['method' => 'POST', 'url' => 'business']) !!}
            {{-- Start Date Select --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12  custom-input-group">
                <a class="custom-label">日付</a>
                <input type="text" name="startDate" id="startDate" value="{{ $startDate }}"/>
            </div>
            {{-- End Date Select --}}
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12  custom-input-group">
                <input type="text" name="endDate" id="endDate" value="{{ $endDate }}"/>
            </div>
            {{-- Office Select --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12  custom-input-group">
                <a class="custom-label">営業所</a>
                <select name="office" id="office">
                    <option value="0" @if($office_id_param == 0) selected @endif></option>
                    @foreach($offices as $office)
                        @if($office->id == $office_id_param)
                            <?= $selected = "selected"; ?>
                        @else
                            <?= $selected = ""; ?>
                        @endif
                        <option value="{{ $office->id }}" {{ $selected }}>{{ $office->office_name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Office Man Select --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12  custom-input-group">
                <a class="custom-label">担当</a>
                <select name="office_man" id="office_man">
                    <option value="0" @if($office_man_id_param == 0) selected @endif></option>
                    @foreach($office_mans as $office_man)
                        @if($office_man->id == $office_man_id_param)
                            <?= $selected = "selected"; ?>
                        @else
                            <?= $selected = ""; ?>
                        @endif
                        <option value="{{ $office_man->id }}" {{ $selected }}>{{ $office_man->office_man_name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Search Button --}}
            <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12  custom-input-group">
                <input type="submit" class="btn" name="search_submit" id="search_submit" value="検索"/>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4  search-form" style="float: right;">
            <div class="col-lg-offset-5 col-lg-3 col-md-5 col-sm-12 col-xs-12">
                <a class="btn btn-success" href="{{ URL::to('branch') }}">メインメニュー</a>
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12 col-xs-12">
                <a class="btn btn-danger" href="{{ URL::to('logout') }}">ログアウト</a>
            </div>
        </div>
    </section>
    {{-- Business Section --}}
    <section id="business-calendar" oncontextmenu="return false;">
        <table class="table table-bordered">
            {{-- Table Header --}}
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>担当</th>
                    {{-- Office Man Names --}}
                    @foreach($office_mans as $office_man)
                        <th colspan="2">{{ $office_man->office_man_name }}</th>
                    @endforeach
                </tr>
                <tr>
                    <th>日付</th>
                    <th>営業所</th>
                    {{-- Office Names --}}
                    @foreach($office_mans as $office_man)
                        <th colspan="2">{{ $office_man->office_name }}</th>
                    @endforeach
                </tr>
            </thead>
            {{-- Table Body --}}
            <tbody>
                @for($i = $start['day']; $i < $end['day'] + 1; $i ++)
                    <tr>
                        {{-- Main Date --}}
                        <td class="vertical-align-td" constant_width="date">{{ $start['month'] }}/{{ $i }}/{{ $start['year'] }}</td>
                        {{-- Names --}}
                        <td constant_width="item">
                            <table class="deep-2-table item-table">
                                @for($j = 0; $j < 4; $j ++)
                                <tr>
                                    <td>
                                        <table class="table table-bordered deep-3-table label-table">
                                            <tr>
                                                {{-- Address --}}
                                                <td class="col-sm-12">
                                                    <input type="text" class="col-lg-12" name="" value="住所" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                {{-- Field --}}
                                                <td class="col-sm-12">
                                                    <input type="text" class="col-lg-12" name="" value="現場名" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                {{-- Field --}}
                                                <td class="col-sm-12">
                                                    <input type="text" class="col-lg-12" name="" value="内容" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                {{-- Time --}}
                                                <td class="col-sm-12">
                                                    <input type="text" class="col-lg-12" name="" value="時間" readonly/>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endfor
                            </table>
                        </td>
                        @foreach($office_mans as $o => $office_man)
                        {{--Left--}}
                        <td class="border-bottom-black-td">
                            <table class="deep-2-table">
                                @for($j = 0; $j < 4; $j ++)
                                    <?php
                                        $main_date = \Carbon\Carbon::createFromDate($start['year'], $start['month'], $i)->format("Y-m-d");
                                        $cell_id = $j * 2 + 1;
                                        $busi_cal = \App\BusinessCalendar::where('main_date', $main_date)->where('office_man_id', $office_man->id)->where('cell_id', $cell_id)->first();
                                        if($busi_cal->trans_item_id != '0')
                                        {
                                            $trans_item = \App\Item::where('id', $busi_cal->trans_item_id)->first();
                                            $trans_item_mark_color = $trans_item->mark_color;
                                        }
                                        else
                                        {
                                            $trans_item_mark_color = '1';
                                        }
                                    ?>
                                    <tr>
                                        <td>
                                            <table class="table deep-3-table">
                                                <tr>
                                                    {{-- Address --}}
                                                    <td class="col-sm-12 border-black-1-td">
                                                        @if($auth == "comm_user")
                                                            <input type="text" class="col-lg-12" style="background-color: @if($busi_cal->order_check == 1) #ccffcc @elseif($busi_cal->order_check == 2) #ff99cc @else #ffffff @endif" name="" id="{{ $busi_cal->id }}" day="{{ $i - 1 }}" man_num="{{ $o }}" width_cell="0" height_cell="{{ $j }}" value="{{ $busi_cal->address }}" readonly/>
                                                        @else
                                                            <input type="text" class="col-lg-12 data" style="background-color: @if($busi_cal->order_check == 1) #ccffcc @elseif($busi_cal->order_check == 2) #ff99cc @else #ffffff @endif" name="address" id="{{ $busi_cal->id }}" day="{{ $i - 1 }}" man_num="{{ $o }}" width_cell="0" height_cell="{{ $j }}" value="{{ $busi_cal->address }}"/>
                                                        @endif
                                                        {{-- Order Check --}}
                                                        <div class="order_grid" id="{{ $busi_cal->id }}" >
                                                            <div class="up" id="{{ $busi_cal->id }}">
                                                                <span class="check_green_color">a</span>見積
                                                            </div>
                                                            <div class="down" id="{{ $busi_cal->id }}">
                                                                <span class="check_pink_color">a</span>受注
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    {{-- Field --}}
                                                    <td class="col-sm-12 border-black-2-td">
                                                        <input type="text" class="col-lg-12 data" name="field_name" id="{{ $busi_cal->id }}" value="{{ $busi_cal->field_name }}" @if($auth == "comm_user") readonly @endif/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    {{-- Item --}}
                                                    <td class="col-sm-12 border-black-3-td">
                                                        <select class="col-lg-12 data" style="color: @if($trans_item_mark_color == '1') #000000 @elseif($trans_item_mark_color == '2') #ff0000 @else #0000ff @endif" onchange="this.style.color=this.options[this.selectedIndex].style.color" name="trans_item_id" id="{{ $busi_cal->id }}" @if($auth == "comm_user") disabled @endif>
                                                            <option value="0" @if($busi_cal->trans_item_id == 0) selected @endif></option>
                                                            @foreach($trans_items as $trans_item)
                                                                @if($trans_item->id == $busi_cal->trans_item_id)
                                                                    <?= $selected = "selected"; ?>
                                                                @else
                                                                    <?= $selected = "";?>
                                                                @endif
                                                                    <option value="{{ $trans_item->id }}" style="color: @if($trans_item->mark_color == '1') #000000 @elseif($trans_item->mark_color == '2') #ff0000 @else #0000ff @endif" {{ $selected }}>{{ $trans_item->item_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    {{-- Time --}}
                                                    <td class="col-sm-12 border-black-4-td">
                                                        <input type="text" class="col-lg-12 data" name="time" id="{{ $busi_cal->id }}" value="{{ $busi_cal->time }}" @if($auth == "comm_user") readonly @endif/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                        <input type="hidden" name="main_date{{ $busi_cal->id }}" id="main_date{{ $busi_cal->id }}" value="{{ $main_date }}">
                                        <input type="hidden" name="office_man_id{{ $busi_cal->id }}" id="office_man_id{{ $busi_cal->id }}" value="{{ $office_man->id }}">
                                @endfor
                            </table>
                        </td>
                        {{--Right--}}
                        <td class="border-black-td">
                            <table class="deep-2-table">
                                @for($j = 0; $j < 4; $j ++)
                                    <?php
                                        $main_date = \Carbon\Carbon::createFromDate($start['year'], $start['month'], $i)->format("Y-m-d");
                                        $cell_id = ($j + 1) * 2;
                                        $busi_cal = \App\BusinessCalendar::where('main_date', $main_date)->where('office_man_id', $office_man->id)->where('cell_id', $cell_id)->first();
                                        if($busi_cal->trans_item_id != '0')
                                        {
                                            $trans_item = \App\Item::where('id', $busi_cal->trans_item_id)->first();
                                            $trans_item_mark_color = $trans_item->mark_color;
                                        }
                                        else
                                        {
                                            $trans_item_mark_color = '1';
                                        }
                                    ?>
                                    <tr>
                                        <td>
                                            <table class="table deep-3-table">
                                                <tr>
                                                    {{-- Address --}}
                                                    <td class="col-sm-12 border-black-1-td">
                                                        @if($auth == "comm_user")
                                                            <input type="text" class="col-lg-12" style="background-color: @if($busi_cal->order_check == 1) #ccffcc @elseif($busi_cal->order_check == 2) #ff99cc @else #ffffff @endif" name="" id="{{ $busi_cal->id }}" day="{{ $i - 1 }}" man_num="{{ $o }}" width_cell="1" height_cell="{{ $j }}" value="{{ $busi_cal->address }}" readonly/>
                                                        @else
                                                            <input type="text" class="col-lg-12 data" style="background-color: @if($busi_cal->order_check == 1) #ccffcc @elseif($busi_cal->order_check == 2) #ff99cc @else #ffffff @endif" name="address" id="{{ $busi_cal->id }}" day="{{ $i - 1 }}" man_num="{{ $o }}" width_cell="1" height_cell="{{ $j }}" value="{{ $busi_cal->address }}"/>
                                                        @endif
                                                        {{-- Order Check --}}
                                                        <div class="order_grid" id="{{ $busi_cal->id }}" >
                                                            <div class="up" id="{{ $busi_cal->id }}">
                                                                <span class="check_green_color">a</span>見積
                                                            </div>
                                                            <div class="down" id="{{ $busi_cal->id }}">
                                                                <span class="check_pink_color">a</span>受注
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    {{-- Field --}}
                                                    <td class="col-sm-12 border-black-2-td">
                                                        <input type="text" class="col-lg-12 data" name="field_name" id="{{ $busi_cal->id }}" value="{{ $busi_cal->field_name }}" @if($auth == "comm_user") readonly @endif/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    {{-- Item --}}
                                                    <td class="col-sm-12 border-black-3-td">
                                                        <select class="col-lg-12 data" style="color: @if($trans_item_mark_color == '1') #000000 @elseif($trans_item_mark_color == '2') #ff0000 @else #0000ff @endif" onchange="this.style.color=this.options[this.selectedIndex].style.color" name="trans_item_id" id="{{ $busi_cal->id }}" @if($auth == "comm_user") disabled @endif >
                                                            <option value="0" @if($busi_cal->trans_item_id == 0) selected @endif></option>
                                                            @foreach($trans_items as $trans_item)
                                                                @if($trans_item->id == $busi_cal->trans_item_id)
                                                                    <?= $selected = "selected"; ?>
                                                                @else
                                                                    <?= $selected = "";?>
                                                                @endif
                                                                <option value="{{ $trans_item->id }}" style="color: @if($trans_item->mark_color == '1') #000000 @elseif($trans_item->mark_color == '2') #ff0000 @else #0000ff @endif" {{ $selected }}>{{ $trans_item->item_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    {{-- Time --}}
                                                    <td class="col-sm-12 border-black-4-td">
                                                        <input type="text" class="col-lg-12 data" name="time" id="{{ $busi_cal->id }}" value="{{ $busi_cal->time }}" @if($auth == "comm_user") readonly @endif/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                        <input type="hidden" name="main_date{{ $busi_cal->id }}" id="main_date{{ $busi_cal->id }}" value="{{ $main_date }}">
                                        <input type="hidden" name="office_man_id{{ $busi_cal->id }}" id="office_man_id{{ $busi_cal->id }}" value="{{ $office_man->id }}">
                                @endfor
                            </table>
                        </td>
                        @endforeach
                    </tr>
                @endfor
            </tbody>
        </table>
        <input type="hidden" name="url" id="url" value="{{ URL::to('business/update') }}"/>
        <input type="hidden" name="updateOrderStateUrl" id="updateOrderStateUrl" value="{{ URL::to('business/updateOrderState') }}"/>
        <input type="hidden" name="editStatusUrl" id="editStatusUrl" value="{{ URL::to('business/editCheck') }}">

        <input type="hidden" name="user" id="user" value="{{ $user }}">

        <input type="hidden" name="preMainDate" id="preMainDate" value="">
        <input type="hidden" name="preOfficeManId" id="preOfficeManId" value="">
    </section>
    <script>
        $(function() {
            user = $('#user').val();
            url  = $('#editStatusUrl').val();
            $.get(url, {
                refresh: "true",
                user: user
            }, function(data) {
                console.log(data);
            });
        });
    </script>
@stop