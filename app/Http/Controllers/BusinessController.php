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
use Illuminate\Support\Facades\Session;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Identify session
         *
         */
        if(Session::get('auth'))
        {
            /**
             *
             */
            $auth = Session::get('auth');

            /**
             * Get search parameters
             *
             * startDate
             */
            if (Input::get('startDate')) {
                $startDate = Input::get('startDate');

                $startYear = Carbon::createFromFormat('m/d/Y', $startDate)->format('Y');
                $startMonth = Carbon::createFromFormat('m/d/Y', $startDate)->format('n');
                $startDay = Carbon::createFromFormat('m/d/Y', $startDate)->format('j');
            } else {
                $startYear = Carbon::today()->format('Y');
                $startMonth = Carbon::today()->format('n');
                $startDay = 1;

                $startDate = Carbon::createFromFormat('Y-m-d', $startYear . "-" . $startMonth . "-" . $startDay)->format('m/d/Y');
            }

            /**
             * Get search parameters
             *
             * endDate
             */
            if (Input::get('endDate')) {
                $endDate = Input::get('endDate');

                $endYear = Carbon::createFromFormat('m/d/Y', $endDate)->format('Y');
                $endMonth = Carbon::createFromFormat('m/d/Y', $endDate)->format('n');
                $endDay = Carbon::createFromFormat('m/d/Y', $endDate)->format('j');
            } else {
                $endYear = Carbon::today()->format('Y');
                $endMonth = Carbon::today()->format('n');

                // days of current month
                if ($endYear % 4 == 0 && $endMonth == 2) {
                    $endDay = 29;
                } else if ($endYear % 4 != 0 && $endMonth == 2) {
                    $endDay = 28;
                } else if ($endMonth == 1 || $endMonth == 3 || $endMonth == 5 || $endMonth == 7 || $endMonth == 8 || $endMonth == 10 || $endMonth == 12) {
                    $endDay = 31;
                } else {
                    $endDay = 30;
                }

                $endDate = Carbon::createFromFormat('Y-m-d', $endYear . "-" . $endMonth . "-" . $endDay)->format('m/d/Y');
            }

            /**
             * Query init
             */
            $queryOfficeMans = OfficeMan::where('v_status', '1');

            /**
             * Get search parameters
             *
             * office
             */
            if (Input::get('office')) {
                $office_id_param = Input::get('office');
                $queryOfficeMans
                    ->where('office_id', $office_id_param);
            } else {
                $office_id_param = 0;
            }

            /**
             * Get search parameters
             *
             * office
             */
            if (Input::get('office_man')) {
                $office_man_id_param = Input::get('office_man');
                $queryOfficeMans
                    ->where('id', $office_man_id_param)
                    ->orderBy('v_index');
            } else {
                $queryOfficeMans
                    ->orderBy('v_index');
                $office_man_id_param = 0;
            }

            // All office_mans
            $office_mans = $queryOfficeMans->get();
            // All offices
            $offices = Office::orderBy('v_index')->get();

            /**
             * Initialization busi_cal table with init values for this month if it is empty.
             * At first loop with office_man
             */
            foreach ($office_mans as $office_man) {
                $compare_date = Carbon::createFromDate($startYear, $startMonth)->format("Y-m"); // valid exist data or not
                // check if empty for this office_man
                $busi_cal_test = BusinessCalendar::where('office_man_id', $office_man['id'])->where('main_date', 'like', '%' . $compare_date . '%')->first();
                if ($busi_cal_test) {

                } else {
                    // loop with day
                    for ($j = 0; $j < $endDay; $j++) {
                        $dd = $j + 1; // day

                        // loop with cell_id (default: 8)
                        for ($k = 0; $k < 8; $k++) {
                            $busi_cal = []; // a new BusinessCalendar

                            $main_date = Carbon::createFromDate($startYear, $startMonth, $dd)->format("Y-m-d"); // main_date
                            $office_id = $office_man['office_id'];                                    // office_id
                            $office_man_id = $office_man['id'];                                           // office_man_id
                            $cell_id = $k + 1;                                                      // cell_id
                            $address = '';                                                          // address
                            $field_name = '';                                                          // field_name
                            $trans_item_id = 0;                                                           // trans_item_id
                            $time = '';                                                          // time
                            $order_check = 0;                                                           // order_check
                            $edit_status = 0;                                                           // edit_status

                            // create initiate busi_cal table with empty value
                            $busi_cal['main_date'] = $main_date;
                            $busi_cal['office_id'] = $office_id;
                            $busi_cal['office_man_id'] = $office_man_id;
                            $busi_cal['cell_id'] = $cell_id;
                            $busi_cal['address'] = $address;
                            $busi_cal['field_name'] = $field_name;
                            $busi_cal['trans_item_id'] = $trans_item_id;
                            $busi_cal['time'] = $time;
                            $busi_cal['order_check'] = $order_check;
                            $busi_cal['edit_status'] = $edit_status;

                            BusinessCalendar::create($busi_cal);
                        }
                    }
                }
            }

            // Converting office_id to office_name
            foreach ($office_mans as $office_man) {
                $office = Office::where('id', $office_man['office_id'])->first();
                $office_man['office_name'] = $office['office_name'];
            }

            // start year, month day
            $start = [];
            $start['year'] = $startYear;
            $start['month'] = $startMonth;
            $start['day'] = $startDay;

            // start year, month day
            $end = [];
            $end['year'] = $endYear;
            $end['month'] = $endMonth;
            $end['day'] = $endDay;

            // all transaction items
            $trans_items = Item::all();

            return view('business.index', compact(
                'auth',
                'offices',
                'office_mans',
                'startDate',
                'endDate',
                'start',
                'end',
                'office_id_param',
                'office_man_id_param',
                'trans_items'
            ));
        }
        else
        {
            return view('errors.503');
        }
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
     * Update order state
     */
    public function updateOrderState()
    {
        $id    = Input::get('id');
        $state = Input::get('state');

        BusinessCalendar::where('id', $id)->update(['order_check' => $state]);
        echo "Order State Updated";
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
