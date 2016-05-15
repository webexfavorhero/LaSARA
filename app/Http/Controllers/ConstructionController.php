<?php

namespace App\Http\Controllers;

use App\CompanyMan;
use App\ConstructionCalendar;
use Carbon\Carbon;
use App\Company;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ConstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Get office id
         *
         */
        $office_id = 1;
        if(Input::get('office_id'))
        {
            $office_id = Input::get('office_id');
        }

        /**
         * Get year, month
         */
        $year  = Carbon::today()->format('Y'); // default current year
        $month = Carbon::today()->format('n'); // default current month
        if(Input::get('year'))
        {
            $year = Input::get('year');
        }
        if(Input::get('month'))
        {
            $month = Input::get('month');
        }

        /**
         * Get days
         */
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
         * Get company mans
         *
         */
        $company_mans = CompanyMan::where('office_id', $office_id)
            ->orderBy('company_id')
            ->get();
        foreach($company_mans as $i => $company_man)
        {
            /**
             * Get company name
             */
            $company = Company::where('id', $company_man['company_id'])
                ->first();
            $company_man['company_name'] = $company['company_name'];

            /**
             * Check existing
             */
            $cons_cal_ = ConstructionCalendar::where('company_man_id', $company_man['id'])
                ->where('main_date', '>=', Carbon::createFromFormat('Y-m', $year . "-" . $month)->toDateString())
                ->where('main_date', '<=', Carbon::createFromFormat('Y-m-d', $year . "-" . $month . "-31" )->toDateString())
                ->first();

            /**
             * If does not exist in database, create
             */
            if(!$cons_cal_)
            {
                for($j = 1; $j < $days + 1; $j ++)
                {
                    for($k = 1; $k < 4; $k ++)
                    {
                        $cons_cal = array();

                        $cons_cal['office_id']      = $office_id;
                        $cons_cal['company_id']     = $company_man['company_id'];
                        $cons_cal['company_man_id'] = $company_man['id'];;
                        $cons_cal['main_date']      = Carbon::createFromFormat('Y-m-d', $year . "-" . $month . "-" . $j)->toDateString();
                        $cons_cal['cell_id']        = $k;
                        $cons_cal['field_name']     = "";
                        $cons_cal['char_color']     = 0;
                        $cons_cal['content']        = "";
                        $cons_cal['back_color']     = 0;
                        $cons_cal['start_time']     = "";
                        $cons_cal['order_amount']   = "";

                        ConstructionCalendar::create($cons_cal);
                    }
                }
            }
        }

        return view('constr.index', compact(
            'office_id',
            'year',
            'month',
            'days',
            'company_mans'
        ));
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
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $cons_cal = ConstructionCalendar::findOrFail($id);

        $cons_cal->update($input);

        return redirect()->back();
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
