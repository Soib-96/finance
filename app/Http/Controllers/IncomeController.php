<?php

namespace App\Http\Controllers;

use App\Purse;
use Illuminate\Http\Request;
use App\Income;
use Illuminate\Support\Facades\Auth;

class IncomeController extends MainController
{

    public function __construct()
    {
        $this->template = 'incomes.income_view';
    }


    public function index()
    {
        $this->title = 'Доходы';

        $user = Auth()->user();

        $this->content = view('incomes.income_content')->with('user',$user);
        return $this->renderOutput();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Добавление дохода';

        $user = Auth()->user();

        $this->content = view('incomes.income_add')->with('user',$user);
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
        $data = $request->except('_token');

        $user = Auth::user()->id;

        $incomeSum = $data['sum'];

        $purseSum = Purse::find($data['purse_id']);

        $purseSum['sum'] = $purseSum['sum'] + $incomeSum;

        $purseSum->update();

        $income = new Income();

        $income->user_id = $user;
        $income->category_id = $data['category_id'];
        $income->purse_id = $data['purse_id'];

        $income->fill($data);

        if ($income->save())
        {
            return redirect('/incomes')->with('status','Доход добавлен');
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
