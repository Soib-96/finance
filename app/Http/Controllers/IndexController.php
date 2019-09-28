<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purse;
use App\User;
use Auth;

class IndexController extends MainController
{
    
    public function __construct()
    {
    	$this->template = 'view';
    }

    public function view()
    {
    	$this->title = 'Главная';

        $user = Auth()->user();


    	$this->content = view('content_index')->with('user',$user)->render();;


    	return $this->renderOutput();
    }


    public function getPurses()
    {

        $purses = Purse::all();
        return $purses;
    }


    public function addPhoto($user_id)
    {
        $user_id = User::find($user_id)->id;
        dd($user_id);
    }

}
