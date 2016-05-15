<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\CompanyMan;
use App\Company;
use App\Office;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use App\Http\Requests\CreateCompanyManRequest;

class CompanyManController extends Controller
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
        if(Session::get('auth')) {
            $auth = Session::get('auth');

            if ($auth == "manager") {
                // All CompanyMans
                $companymans = CompanyMan::all();

                // Converting office_id, company_id to office_name, company_name
                foreach ($companymans as $companyman) {
                    $office = Office::where('id', $companyman['office_id'])->first();
                    $company = Company::where('id', $companyman['company_id'])->first();

                    $companyman['office_name'] = $office['office_name'];
                    $companyman['company_name'] = $company['company_name'];
                }

                // All offices
                $offices = Office::all();

                return view('basic.companyman.index', compact('companymans', 'offices', 'companies'));
            }
            else
            {
                return view('errors.503');
            }
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
    public function store(CreateCompanyManRequest $request)
    {
        $input = $request->all();
        CompanyMan::create($input);

        Session::flash('success', '正常に作成。');
        return redirect()->back();
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
        $companyman = CompanyMan::findOrFail($id);

        // All companymans
        $companymans = CompanyMan::all();
        // Converting office_id, company_id to office_name, company_name
        foreach($companymans as $companyman_)
        {
            $office = Office::where('id', $companyman_['office_id'])->first();
            $company = Company::where('id', $companyman_['company_id'])->first();

            $companyman_['office_name'] = $office['office_name'];
            $companyman_['company_name'] = $company['company_name'];
        }

        // All offices
        $offices = Office::all();
        // All companies
        $companies = Company::where('office_id', $companyman['office_id'])->get();

        return view('basic.companyman.edit', compact('companyman', 'offices', 'companies', 'companymans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCompanyManRequest $request, $id)
    {
        $input = $request->all();

        $companyman = CompanyMan::findOrFail($id);

        $companyman->update($input);
        Session::flash('success', '正常に更新。');
        return redirect('/basic/companyman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companyman = CompanyMan::findOrFail($id);

        $companyman->delete();
        Session::flash('success', '正常に削除されました。');
        return redirect('/basic/companyman');
    }

    /**
     * Ajax communication(GET)
     * Response companies for special office_id request
     */
    public function companiesFromOffice()
    {
        $office_id = Input::get('office_id');

        $companies = Company::where('office_id', $office_id)->get();

        echo json_encode($companies);
    }
}
