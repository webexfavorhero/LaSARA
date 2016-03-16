@extends('app')

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
                            <table class="deep-2-table">
                                @for($j = 0; $j < 4; $j ++)
                                <tr>
                                    <td>
                                        <table class="table table-bordered deep-3-table">
                                            <tr>
                                                <td>住所</td>
                                            </tr>
                                            <tr>
                                                <td>現場名</td>
                                            </tr>
                                            <tr>
                                                <td>内容</td>
                                            </tr>
                                            <tr>
                                                <td>時間</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endfor
                            </table>
                        </td>
                        @foreach($office_mans as $office_man)
                        <td>
                            <table class="deep-2-table">
                                @for($j = 0; $j < 4; $j ++)
                                    <tr>
                                        <td>
                                            <table class="table table-bordered deep-3-table">
                                                <tr>
                                                    <td>住所</td>
                                                </tr>
                                                <tr>
                                                    <td>現場名</td>
                                                </tr>
                                                <tr>
                                                    <td>内容</td>
                                                </tr>
                                                <tr>
                                                    <td>時間</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                @endfor
                            </table>
                        </td>
                        <td>
                            <table class="deep-2-table">
                                @for($j = 0; $j < 4; $j ++)
                                    <tr>
                                        <td>
                                            <table class="table table-bordered deep-3-table">
                                                <tr>
                                                    <td>住所</td>
                                                </tr>
                                                <tr>
                                                    <td>現場名</td>
                                                </tr>
                                                <tr>
                                                    <td>内容</td>
                                                </tr>
                                                <tr>
                                                    <td>時間</td>
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
    </section>
@stop