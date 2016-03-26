@extends('app')

@section('scripts')
    <script src="{!! asset('js/module_update.js') !!}"></script>
@stop

@section('content')
    <section id="business-calendar">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>担当</th>
                    @foreach($office_mans as $office_man)
                        <th colspan="2">{{ $office_man->office_man_name }}</th>
                    @endforeach
                </tr>
                <tr>
                    <th>日付</th>
                    <th>営業所</th>
                    @foreach($office_mans as $office_man)
                        <th colspan="2">{{ $office_man->office_name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < $date['days']; $i ++)
                    <tr>
                        <td class="vertical-align-td">{{ $date['month'] }}/{{ $i + 1 }}/{{ $date['year'] }}</td>
                        <td>
                            <table class="deep-2-table item-table">
                                @for($j = 0; $j < 4; $j ++)
                                <tr>
                                    <td>
                                        <table class="table table-bordered deep-3-table label-table">
                                            <tr>
                                                <td class="col-sm-12">
                                                    <input type="text" class="col-lg-12" name="" value="住所" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-sm-12">
                                                    <input type="text" class="col-lg-12" name="" value="現場名" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-sm-12">
                                                    <input type="text" class="col-lg-12" name="" value="内容" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
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
                        @foreach($office_mans as $office_man)
                            {{--Left--}}
                        <td class="border-bottom-black-td">
                            <table class="deep-2-table">
                                @for($j = 0; $j < 4; $j ++)
                                    <?php
                                        $main_date = \Carbon\Carbon::createFromDate($date['year'], $date['month'], $i + 1)->format("Y-m-d");
                                        $cell_id = $j * 2 + 1;
                                        $busi_cal = \App\BusinessCalendar::where('main_date', $main_date)->where('office_man_id', $office_man->id)->where('cell_id', $cell_id)->first();
                                    ?>
                                    <tr>
                                        <td>
                                            <table class="table deep-3-table">
                                                <tr>
                                                    <td class="col-sm-12 border-black-1-td">
                                                        <input type="text" class="col-lg-12" style="background-color: @if($busi_cal->order_check == 1) #ccffcc @elseif($busi_cal->order_check == 2) #ff99cc @else #ffffff @endif" name="address" id="{{ $busi_cal->id }}" value="{{ $busi_cal['address'] }}"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-sm-12 border-black-2-td">
                                                        <input type="text" class="col-lg-12" name="field_name" id="{{ $busi_cal->id }}" value="{{ $busi_cal['field_name'] }}"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-sm-12 border-black-3-td">
                                                        <select class="col-lg-12" name="trans_item_id" id="{{ $busi_cal->id }}">
                                                            <option value="0" @if($busi_cal['trans_item_id'] == 0) selected @endif></option>
                                                            @foreach($trans_items as $trans_item)
                                                                @if($trans_item->id == $busi_cal['trans_item_id'])
                                                                    <?= $selected = "selected"; ?>
                                                                @else
                                                                    <?= $selected = "";?>
                                                                @endif
                                                                    <option value="{{ $trans_item->id }}" {{ $selected }}>{{ $trans_item->item_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-sm-12 border-black-4-td">
                                                        <input type="text" class="col-lg-12" name="time" id="{{ $busi_cal->id }}" value="{{ $busi_cal['time'] }}"/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                @endfor
                            </table>
                        </td>
                            {{--Right--}}
                        <td class="border-black-td">
                            <table class="deep-2-table">
                                @for($j = 0; $j < 4; $j ++)
                                    <?php
                                    $main_date = \Carbon\Carbon::createFromDate($date['year'], $date['month'], $i + 1)->format("Y-m-d");
                                    $cell_id = ($j + 1) * 2;
                                    $busi_cal = \App\BusinessCalendar::where('main_date', $main_date)->where('office_man_id', $office_man->id)->where('cell_id', $cell_id)->first();
                                    ?>
                                    <tr>
                                        <td>
                                            <table class="table deep-3-table">
                                                <tr>
                                                    <td class="col-sm-12 border-black-1-td">
                                                        <input type="text" class="col-lg-12" style="background-color: @if($busi_cal->order_check == 1) #ccffcc @elseif($busi_cal->order_check == 2) #ff99cc @else #ffffff @endif" name="address" id="{{ $busi_cal->id }}" value="{{ $busi_cal['address'] }}"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-sm-12 border-black-2-td">
                                                        <input type="text" class="col-lg-12" name="field_name" id="{{ $busi_cal->id }}" value="{{ $busi_cal['field_name'] }}"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-sm-12 border-black-3-td">
                                                        <select class="col-lg-12" name="trans_item_id" id="{{ $busi_cal->id }}" >
                                                            <option value="0" @if($busi_cal['trans_item_id'] == 0) selected @endif></option>
                                                            @foreach($trans_items as $trans_item)
                                                                @if($trans_item->id == $busi_cal['trans_item_id'])
                                                                    <?= $selected = "selected"; ?>
                                                                @else
                                                                    <?= $selected = "";?>
                                                                @endif
                                                                <option value="{{ $trans_item->id }}" {{ $selected }}>{{ $trans_item->item_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-sm-12 border-black-4-td">
                                                        <input type="text" class="col-lg-12" name="time" id="{{ $busi_cal->id }}" value="{{ $busi_cal['time'] }}"/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                @endfor
                            </table>
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                    </tr>
                @endfor
            </tbody>
        </table>
        <input type="hidden" name="url" id="url" value="{{ URL::to('business/update') }}"/>
    </section>
@stop