<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Purse;

class PursesController extends MainController
{


    public function __construct()
    {
        $this->template = 'purses.purse_view';
    }



    public function index()
    {

        $this->title = "Кошельки";

        $user = Auth()->user();

        $this->content = view('purses.purses_content')->with('user',$user)->render();

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = "Добавление нового кошелька";

        $this->content = view('purses.purse_add')->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth()->user()->id;

        $data = $request->except('_token');

        $purse = new Purse();

        $purse->user_id = $user;

        $purse->fill($data);

        if ($purse->save())
        {
            return redirect('/purses')->with('status','Кошелек добавлен');
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
