<?php

namespace App\Http\Controllers;

use App\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lang;

class DebtsController extends MainController
{

    public function __construct()
    {
        $this->template = 'debts.debt_view';
    }


    public function index()
    {
        $this->title = 'Долги';

        $user = Auth()->user();
        $this->content = view('debts.debt_content')->with('user',$user);
        return $this->renderOutput();
    }


    public function create()
    {
        $this->title = Lang::get('ru.add_debts');

        $user = Auth()->user();

        $this->content = view('debts.debt_add')->with('user',$user);
        return $this->renderOutput();
    }

    public function store(Request $request)
    {
        $request->validate([
            'sum' => 'required|integer|max:214748364',
        ]);

        $data = $request->except('_token');
        $user = Auth::user();
        $purse = $this->getPurse($data['purse_id']);

        if ($data['sum'] > $purse->sum)
        {
            return back()->withErrors('У вас недостаточно средств!');
        }

        $this->debtOperation($data,$purse);

        $debt = new Debt();

        $debt->user_id = $user->id;
        $debt->purse_id = $purse->id;
        $debt->fill($data);

        if ($debt->save())
        {
            return redirect('/debts')->with('status','Долг добавлен');
        }
    }

    protected function debtOperation($data,$purse)
    {
        $debtSum = $data['sum'];

        if($data['type'] == 1)
        {
                $purse->sum = $purse->sum - $debtSum;
                $purse->update();
        }else
        {
            $purse->sum = $purse->sum + $debtSum;
            $purse->update();
        }
    }

    public function getDebt($id)
    {
        return Debt::find($id);
    }


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
        $debt = $this->getDebt($id);
        $purse = $this->getPurse($debt->purse_id);

        if ($debt->type == 1)
        {
            $purse->sum = $purse->sum + $debt->sum;
            $purse->update();
        }else
            {
                if ($debt->sum > $purse->sum)
                {
                    return back()->withErrors('У вас недостаточно средств!');
                }else
                {
                    $purse->sum = $purse->sum - $debt->sum;
                    $purse->update();
                }
            }
        if ($debt->delete())
        {
            return redirect('/debts')->with('status','Долг погашен');
        }
    }


}
