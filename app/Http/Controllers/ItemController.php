<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Item;
use Session;
use Request;
use DB;
use App\Http\Requests\CreateItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();

        return view('basic.item.index', compact('items'));
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
    public function store(CreateItemRequest $request)
    {
        $input = $request->all();

        $v_index = $input['v_index'];
        $item = Item::where('v_index', $v_index)->first();

        if ($item)
        {
            Session::flash('error', '既に同じ管理番号を存在します。');
            return redirect('/basic/item');
        }
        else
        {
            $huri_item_name = $input['huri_item_name'];
            $item = Item::where('huri_item_name', $huri_item_name)->first();

            if ($item)
            {
                Session::flash('error', '既に同じ項目のフリガナ名を存在します。');
                return redirect('/basic/item');
            }
            else
            {
                $item_name = $input['item_name'];
                $item = Item::where('item_name', $item_name)->first();

                if ($item) {
                    Session::flash('error', '既に同じ項目名を存在します。');
                    return redirect('/basic/item');
                }
                else
                {
                    Item::create($input);
                    Session::flash('success', '正常に作成。');
                    return redirect('/basic/item');
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
        $item = Item::findOrFail($id);
        $items = Item::all();

        return view('basic.item.edit', compact('items', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateItemRequest $request, $id)
    {
        $item_ = Item::findOrFail($id);

        $input = $request->all();

        $item_->update($input);
        Session::flash('success', '正常に更新。');
        return redirect('/basic/item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        Session::flash('success', '正常に削除されました。');
        return redirect('/basic/item');
    }
}
