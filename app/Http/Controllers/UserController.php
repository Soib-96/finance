<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends MainController
{

    public function __construct()
    {
        $this->template = 'users.user_view';
    }

    public function index($user_id)
    {
        $this->title = 'Личные данные';

        $user = Auth()->user();

        $this->content = view('users.user_content')->with('user',$user)->render();;


        return $this->renderOutput();
    }

    public function destroy($user_id)
    {
        $user = Auth::user();
        $user->incomes()->delete();
        $user->expenses()->delete();
        $user->categories()->delete();
        $user->purses()->delete();

        if ($user->delete())
        {
            return redirect('/register');
        }

    }

}
