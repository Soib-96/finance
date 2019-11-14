<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use Lang;
use Auth;

class ExpensesController extends MainController
{

    public function __construct()
    {
        $this->template = 'expenses.expense_view';
    }

    // expenses page
    public function index()
    {
        $this->title = 'Расходы';

        $user = Auth()->user();

        $this->content = view('expenses.expense_content')->with('user',$user);
        return $this->renderOutput();
    }

    // page for creating expense
    public function create()
    {
        $this->title = Lang::get('ru.add_expense');

        $user = Auth()->user();

        $this->content = view('expenses.expense_add')->with('user',$user);
        return $this->renderOutput();
    }

    // add expense in db
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required|max:255',
            'sum' => 'required|integer|max:214748364',
        ]);

        $data = $request->except('_token');

        $user = Auth::user()->id;

        $purseSum = $this->getPurse($data['purse_id']);
        $expenseSum = $data['sum'];

        $purseSum['sum'] = $this->subSum($expenseSum,$purseSum->sum);
        $purseSum->update();

        $expense = new Expense();
        $expense = $this->assigment($expense,$user,$data);
        $expense->fill($data);

        if ($expense->save())
        {
            return redirect('/expenses')->with('status','Расход добавлен');
        }

    }

    // subtraction expense sum in purse
    protected function subSum($expenseSum, $purseSum)
    {
        $purseSum = $purseSum - $expenseSum;
        return $purseSum;
    }

    // show expense
    public function show($id)
    {
        //
    }

    // page for edit expense
    public function edit($id)
    {
        $user = Auth::user();
        $expense = $this->getExpense($id);

        $this->title = Lang::get('ru.edit_income').$expense->name;
        $this->content = view('expenses.expense_add')->with(['user'=>$user,'expense'=>$expense]);
        return $this->renderOutput();
    }

    // get expense
    public function getExpense($id)
    {
        $expense = Expense::find($id);
        return $expense;
    }

    // Update expense in db
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=> 'required|max:255',
            'sum' => 'required|integer|max:214748364',
        ]);

        $data = $request->except('_token');
        $user = Auth::user()->id;
        $purse = $this->getPurse($data['purse_id']);
        $expense = $this->getExpense($id);

        $purse['sum'] = $this->checkSum($data,$expense,$purse);

        $purse->update();

        $expense = $this->assigment($expense,$user,$data);
        $expense->fill($data);

        if ($expense->save())
        {
            return redirect('/expenses')->with('status','Расход обновлен');
        }

    }

    // method for checking change in amount
    protected function checkSum($data,$expense,$purse)
    {
        if ($data['sum'] > $expense['sum'])
        {
            $sumDiff = $data['sum'] - $expense['sum'];

            $purse['sum'] = $this->subSum($sumDiff,$purse['sum']);

        }elseif ($data['sum'] < $expense['sum'])
        {
            $sumDiff = $expense['sum'] - $data['sum'];
            $purse['sum'] = $purse['sum'] + $sumDiff;
        }

        return $purse['sum'];
    }

    // Delete expense from db
    public function destroy($id)
    {
        $expense = $this->getExpense($id);
        $purse = $this->getPurse($expense->purse_id);
        $purse->sum = $purse->sum + $expense->sum;
        $purse->update();

        if ($expense->delete())
        {
            return redirect('/expenses')->with('status','Расход удален');
        }
    }
}
