<?php

namespace App\Http\Controllers;

use Session;

use App\Http\Controllers\Controller;

use App\User;
use Request;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    /**
     *
     */
    public function login()
    {
        $input = Request::all();

        $username = $input['username'];
        $password = $input['password'];

        $manager = DB::table('manager')->where('username', $username)->where('password', $password)->first();

        if ($manager)
        {
            // Assignment session as manager
            Session::set('auth', 'manager');

            return redirect('/basic/user');
        }
        else
        {
            $user = DB::table('users')->where('username', $username)->where('password', $password)->first();

            $permission = "";

            // Permission for editable user/readable user
            if ($user) {
                $permission = $user->permission;
            }

            if ($permission == '1')
            {
                // Assignment session as editable user (permission == 1)
                Session::set('auth', 'edit_user');

                return view('welcome');
            }
            else if ($permission == '0')
            {
                // Assignment session as readable user (permission == 0)
                Session::set('auth', 'comm_user');

                return view('welcome');
            }
            else
            {
                Session::flash('error', 'メールアドレス，またはライセンスキーが違います。');
                return redirect('/');
            }
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        // Free session
        Session::set('auth', '');
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('basic.user');
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
        //
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
