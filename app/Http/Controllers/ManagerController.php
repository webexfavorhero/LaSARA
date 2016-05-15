<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateManagerRequest;
use App\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ManagerController extends Controller
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
                $managers = Manager::all();

                return view('basic.manager.index', compact('managers'));
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
    public function store(CreateManagerRequest $request)
    {
        $input = $request->all();

        $username = $input['username'];
        $manager = Manager::where('username', $username)->first();

        if ($manager)
        {
            Session::flash('error', '既に同じ管理者名を存在します。');
        }
        else
        {
            Manager::create($input);
            Session::flash('success', '正常に作成。');
        }
        return redirect('basic/manager');
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
        $manager = Manager::where('id', $id)->first();

        $managers = Manager::all();

        return view('basic.manager.edit', compact('manager', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateManagerRequest $request, $id)
    {
        $manager_ = Manager::findOrFail($id);

        $input = $request->all();

        $manager_->update($input);
        Session::flash('success', '正常に更新。');
        return redirect('basic/manager');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manager = Manager::findOrFail($id);

        $manager->delete();

        Session::flash('success', '正常に削除されました。');
        return redirect('basic/manager');
    }
}
