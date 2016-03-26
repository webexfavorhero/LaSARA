<?php

namespace App\Http\Controllers;

use App\BusinessCalendar;
use App\Item;
use App\Office;
use App\OfficeMan;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // All office_mans
        $office_mans = OfficeMan::where('v_status', '1')->orderBy('v_index')->get();

        // current year, month
        $year  = Carbon::today()->format('Y');
        $month = Carbon::today()->format('n');

        // days of current month
        if ($year % 4 == 0 && $month == 2)
        {
            $days = 29;
        }
        else if ($year % 4 != 0 && $month == 2)
        {
            $days = 28;
        }
        else if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
        {
            $days = 31;
        }
        else
        {
            $days = 30;
        }

        /**
         * Initialization busi_cal table with init values for this month if it is empty.
         * At first loop with office_man
         */
        foreach($office_mans as $office_man)
        {
            // check if empty for this office_man
            $busi_cal_test = BusinessCalendar::where('office_man_id', $office_man['id'])->first();
            if ($busi_cal_test) {

            }
            else
            {
                // loop with day
                for($j = 0; $j < $days; $j ++)
                {
                    $dd = $j + 1; // day
                    // loop with cell_id (default: 8)
                    for($k = 0; $k < 8; $k ++)
                    {
                        $busi_cal = []; // a new BusinessCalendar

                        $main_date     = Carbon::createFromDate($year, $month, $dd)->format("Y-m-d"); // main_date
                        $office_id     = $office_man['office_id']; // office_id
                        $office_man_id = $office_man['id']; // office_man_id
                        $cell_id       = $k + 1; // cell_id
                        $address       = ''; // address
                        $field_name    = ''; // field_name
                        $trans_item_id = 0; // trans_item_id
                        $time          = ''; // time
                        $order_check   = 0; // order_check
                        $edit_status   = 0; // edit_status

                        // create initiate busi_cal table with empty value
                        $busi_cal['main_date']     = $main_date;
                        $busi_cal['office_id']     = $office_id;
                        $busi_cal['office_man_id'] = $office_man_id;
                        $busi_cal['cell_id']       = $cell_id;
                        $busi_cal['address']       = $address;
                        $busi_cal['field_name']    = $field_name;
                        $busi_cal['trans_item_id'] = $trans_item_id;
                        $busi_cal['time']          = $time;
                        $busi_cal['order_check']   = $order_check;
                        $busi_cal['edit_status']   = $edit_status;

                        BusinessCalendar::create($busi_cal);
                    }
                }
            }
        }

        // Converting office_id to office_name
        foreach($office_mans as $office_man)
        {
            $office = Office::where('id', $office_man['office_id'])->first();
            $office_man['office_name'] = $office['office_name'];
        }

        // date
        $date = [];
        $date['year'] = $year;
        $date['month'] = $month;
        $date['days'] = $days;

        // all transaction items
        $trans_items = Item::all();

        return view('business.index', compact('office_mans', 'date', 'trans_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $name = Input::get('name');
        $id   = Input::get('id');
        $val  = Input::get('val');

        $fields = [
            'address',
            'field_name',
            'trans_item_id',
            'time'
        ];

        $busi_cal = BusinessCalendar::where('id', $id)->first();
        $order_check = $busi_cal['order_check'];

        if ($order_check == '0'
            && $val != "")
        {
            BusinessCalendar::where('id', $id)->update([$name => $val, 'order_check' => '1']);
        }
        else if ($val == '' || $val == '0')
        {
            $count = 0;

            // remove current field name from fields['address', 'field_name', 'trans_item_id', 'time']
            foreach($fields as $i => $field)
            {
                if($field == $name)
                {
                    unset($fields[$i]);
                }
            }
            // check all fields beside current field have "" or 0 already
            foreach($fields as $i => $field)
            {
                if($busi_cal[$field] == '' || $busi_cal[$field] == '0')
                {
                    $count ++;
                }
            }
            // if all fields('address', 'field_name', 'trans_item_id', 'time') has "" or 0, update order_check as 0
            if($count == 3)
            {
                BusinessCalendar::where('id', $id)->update([$name => $val, 'order_check' => '0']);
            }
            else
            {
                BusinessCalendar::where('id', $id)->update([$name => $val]);
            }
        }
        else
        {
            BusinessCalendar::where('id', $id)->update([$name => $val]);
        }
        echo 'ok';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
