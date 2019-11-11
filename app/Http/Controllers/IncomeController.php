<?php

namespace App\Http\Controllers;

use App\Purse;
use Illuminate\Http\Request;
use App\Income;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class IncomeController extends MainController
{

    public function __construct()
    {
        $this->template = 'incomes.income_view';
    }

    // home page
    public function index()
    {
        $this->title = 'Доходы';

        $user = Auth()->user();

        $this->content = view('incomes.income_content')->with('user',$user);
        return $this->renderOutput();

    }

    // page for creating income
    public function create()
    {
        $this->title = Lang::get('ru.add_income');

        $user = Auth()->user();

        $this->content = view('incomes.income_add')->with('user',$user);
        return $this->renderOutput();
    }

    // add income in db
    public function store(Request $request)
    {

        $request->validate([
            'title'=> 'required|max:255',
            'sum' => 'required|integer|max:214748364',
        ]);

        $data = $request->except('_token');

        $user = Auth::user()->id;

        $purseSum = $this->getPurse($data['purse_id']);
        $incomeSum = $data['sum'];


        $purseSum['sum'] = $this->addSum($incomeSum,$purseSum->sum);
        $purseSum->update();

        $income = new Income();

        $income = $this->assigment($income,$user,$data);

        $income->fill($data);

        if ($income->save())
        {
            return redirect('/incomes')->with('status','Доход добавлен');
        }


    }

    // get purse
    public  function getPurse($id)
    {
        $purse = Purse::find($id);
        return $purse;
    }

    // adding income sum in purse
    protected function addSum($sum,$purseSum)
    {
        $purseSum = $purseSum + $sum;
        return $purseSum;
    }

    // assignment value to foreign keys income table
    protected function assigment($income,$user,$data)
    {
        $income->user_id = $user;
        $income->category_id = $data['category_id'];
        $income->purse_id = $data['purse_id'];
        return $income;
    }

    // show income
    public function show($id)
    {

    }

    // page for edit income
    public function edit($id)
    {
        $user = Auth::user();
        $income = $this->getIncome($id);

        $this->title = Lang::get('ru.edit_income').$income->name;
        $this->content = view('incomes.income_add')->with(['user'=>$user,'income'=>$income]);
        return $this->renderOutput();
    }

    // get income
    public function getIncome($id)
    {
        $income = Income::find($id);
        return $income;
    }

    // Update income in db
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=> 'required|max:255',
            'sum' => 'required|integer|max:214748364',
        ]);

        $data = $request->except('_token');
        $user = Auth::user()->id;
        $purse = $this->getPurse($data['purse_id']);
        $income = $this->getIncome($id);


        if ($income->purse_id != $data['purse_id'])
        {
            $oldPurse = $this->getPurse($income->purse->id);

           $oldPurse->sum = $oldPurse->sum - $data['sum'];

           $purse->sum = $purse->sum + $data['sum'];

           $oldPurse->update();
           $purse->update();

        }

        $purse['sum'] = $this->checkSum($data,$income,$purse);

        $purse->update();

        $income = $this->assigment($income,$user,$data);

        $income->fill($data);

        if ($income->update())
        {
            return redirect('/incomes')->with('status','Доход обновлен');
        }

    }

    // method for checking change in amount
    protected function checkSum($data,$income,$purse)
    {
        if ($data['sum'] > $income['sum'])
        {
            $sumDiff = $data['sum'] - $income['sum'];

            $purse['sum'] = $this->addSum($sumDiff,$purse['sum']);
        }elseif ($data['sum'] < $income['sum'])
        {
            $sumDiff = $income['sum'] - $data['sum'];
            $purse['sum'] = $purse['sum'] - $sumDiff;
        }

        return $purse['sum'];
    }


    // Delete income from db
    public function destroy($id)
    {
        $income = $this->getIncome($id);
        $purse = $this->getPurse($income->purse_id);
        $purse->sum = $purse->sum - $income->sum;
        $purse->update();

        if ($income->delete())
        {
            return redirect('/incomes')->with('status','Доход удален');
        }


    }
}
