<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Company;
use App\Office;
use Illuminate\Support\Facades\Session;
use Request;
use DB;
use App\Http\Requests\CreateCompanyRequest;

class CompanyController extends Controller
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

            if ($auth == "manager")
            {
                $companies = Company::all();

                // Converting office_id to office_name
                foreach ($companies as $company) {
                    $office = Office::where('id', $company['office_id'])->first();
                    $company['office_name'] = $office['office_name'];
                }

                $offices = Office::all();

                return view('basic.company.index', compact('companies', 'offices'));
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
    public function store(CreateCompanyRequest $request)
    {
        $input = $request->all();

        Company::create($input);
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
        $company = Company::findOrFail($id);

        $companies = Company::all();

        // Converting office_id to office_name
        foreach($companies as $company_)
        {
            $office = Office::where('id', $company_['office_id'])->first();
            $company_['office_name'] = $office['office_name'];
        }

        $offices = Office::all();
        return view('basic.company.edit', compact('company', 'companies', 'offices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCompanyRequest $request, $id)
    {
        $input = $request->all();

        $company = Company::findOrFail($id);

        $company->update($input);
        Session::flash('success', '正常に更新。');
        return redirect('/basic/company');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        $company->delete();
        Session::flash('success', '正常に削除されました。');
        return redirect('/basic/company');
    }
}
