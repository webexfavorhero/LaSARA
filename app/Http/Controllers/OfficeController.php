<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Office;
use Illuminate\Support\Facades\Session;
use Request;
use DB;
use App\Http\Requests\CreateOfficeRequest;

class OfficeController extends Controller
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
                $offices = Office::all();
                return view('basic.office.index', compact('offices'));
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
    public function store(CreateOfficeRequest $request)
    {
        $input = $request->all();

        $v_index = $input['v_index'];
        $office = Office::where('v_index', $v_index)->first();

        if ($office)
        {
            Session::flash('error', '既に同じ管理番号を存在します。');
            return redirect('/basic/office');
        }
        else
        {
            $huri_office_name = $input['huri_office_name'];
            $office = Office::where('huri_office_name', $huri_office_name)->first();

            if ($office)
            {
                Session::flash('error', '既に同じ営業所のフリガナ名を存在します。');
                return redirect('/basic/office');
            }
            else
            {
                $office_name = $input['office_name'];
                $office = Office::where('office_name', $office_name)->first();

                if ($office) {
                    Session::flash('error', '既に同じ営業所名を存在します。');
                    return redirect('/basic/office');
                }
                else
                {
                    Office::create($input);
                    Session::flash('success', '正常に作成。');
                    return redirect('/basic/office');
                }
            }
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
        $office = Office::findOrFail($id);
        $offices = Office::all();

        return view('basic.office.edit', compact('offices', 'office'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateOfficeRequest $request, $id)
    {
        $office_ = Office::findOrFail($id);

        $input = $request->all();

        $office_->update($input);
        Session::flash('success', '正常に更新。');
        return redirect('/basic/office');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $office = Office::findOrFail($id);
        $office->delete();
        Session::flash('success', '正常に削除されました。');
        return redirect('/basic/office');
    }
}
