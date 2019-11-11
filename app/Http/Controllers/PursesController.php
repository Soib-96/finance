<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;
use Auth;
use App\Purse;
use Illuminate\Support\Facades\Lang;

class PursesController extends MainController
{

    public function __construct()
    {
        $this->template = 'purses.purse_view';
    }

    // home page
    public function index()
    {

        $this->title = "Кошельки";

        $user = Auth()->user();


        $this->content = view('purses.purses_content')->with('user',$user)->render();

        return $this->renderOutput();
    }

    // Page for add new purse
    public function create()
    {
        $this->title = Lang::get('ru.add_purses');

        $currencies = Currency::all();

        $this->content = view('purses.purse_add')->with('currencies',$currencies)->render();

        return $this->renderOutput();
    }

    // Store purse in db
    public function store(Request $request)
    {

        // get user
        $user = Auth()->user()->id;

        $request->validate([
            'name'=> 'required|max:255',
            'sum' => 'required|integer|max:214748364',
        ]);

        $data = $request->except('_token');

        $currency_id = $data['currency_id'];

        $currency = $this->getCurrency($currency_id);

        $purse = new Purse();

        $purse->user_id = $user;
        $purse->currency_id = $currency->id;

        $purse->fill($data);

        if ($purse->save())
        {
            return redirect('/purses')->with('status','Кошелек добавлен');
        }

    }

    // Get currency
    public function getCurrency($currency_id)
    {
        $currency = Currency::where('id',$currency_id)->first();
        return $currency;
    }

    // Show purse
    public function show($id)
    {

    }

    // Page for edit new purse
    public function edit($id)
    {
        $purse = $this->getPurseForUpdate($id);

        $currencies = Currency::all();

        $this->title = Lang::get('ru.edit_purses').$purse->name;

        $this->content = view('purses.purse_add')->with(['purse'=>$purse,'currencies'=>$currencies])->render();

        return $this->renderOutput();

    }

    // Get purse
    protected function getPurseForUpdate($id)
    {
        $purse = Purse::find($id);
        return $purse;
    }

    // Update purse in db
    public function update(Request $request, $id)
    {
        $user = Auth()->user()->id;

        $purse = $this->getPurseForUpdate($id);

        $request->validate([
            'name'=> 'required|max:255',
            'sum' => 'required|integer|max:214748364',
        ]);

        $data = $request->except('_token');

        $currency_id = $data['currency_id'];

        $currency = $this->getCurrency($currency_id);


        $purse->user_id = $user;
        $purse->currency_id = $currency->id;

        $purse->fill($data);

        if ($purse->update())
        {
            return redirect('/purses')->with('status','Кошелек изменён');
        }

    }

    // Delete purse from db
    public function destroy($id)
    {
        $purse = $this->getPurseForUpdate($id);

        $purse->incomes()->delete();
        $purse->expenses()->delete();

        if ($purse->delete())
        {
            return redirect('/purses')->with('status','Кошелек удалён');
        }
    }
}
