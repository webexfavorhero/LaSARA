<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\OfficeMan;
use App\Office;
use Session;
use Request;
use DB;
use App\Http\Requests\CreateOfficeManRequest;

class OfficemanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $officemans = OfficeMan::all();

        // Converting office_id to office_name
        foreach($officemans as $officeman) {
            $office = Office::where('id', $officeman['office_id'])->first();
            $officeman['office_name'] = $office['office_name'];
        }

        $offices = Office::all();
        return view('basic.officeman.index', compact('officemans', 'offices'));
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
    public function store(CreateOfficeManRequest $request)
    {
        $input = $request->all();

        $code = $input['code'];

        $officeman = OfficeMan::where('code', $code)->first();

        if ($officeman)
        {
            Session::flash('error', '既に同じコードを存在します。');
            return redirect()->back();
        }
        else
        {
            OfficeMan::create($input);
            Session::flash('success', '正常に作成。');
            return redirect('/basic/officeman');
        }
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
        $officeman = OfficeMan::findOrFail($id);
        $officemans = OfficeMan::all();

        // Converting office_id to office_name
        foreach($officemans as $officeman_) {
            $office = Office::where('id', $officeman_['office_id'])->first();
            $officeman_['office_name'] = $office['office_name'];
        }

        $offices = Office::all();

        return view('basic.officeman.edit', compact('officeman', 'officemans', 'offices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateOfficeManRequest $request, $id)
    {
        $input = $request->all();
        $officeman = OfficeMan::findOrFail($id);

        $officeman->update($input);

        Session::flash('success', '正常に更新。');
        return redirect('/basic/officeman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $officeman = OfficeMan::findOrFail($id);
        $officeman->delete();
        Session::flash('success', '正常に削除されました。');
        return redirect('/basic/officeman');
    }
}
