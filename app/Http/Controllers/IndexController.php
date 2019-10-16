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


    public function addPhoto($user_id, Request $request)
    {
        $user = User::find($user_id);

        if (isset($_POST['go'])) 
        {
            //  dd($request);
             if ($request->hasFile('images'))
             {
                $file = $request->file('images');

                $format = substr($file->getClientOriginalName(), -4);


                $data['images'] = md5($file->getClientOriginalName()).$format;

                //dd($data['images']);
                $file->move(public_path().'/assets/img/users',$data['images']);
            }else    
            {
                $data['images'] = "";
            }

                $user->images = $data['images'];

                $user->fill($data);

                if ($user->update()) {
                    
                    return redirect('/')->with('status','Фотография успешно установлена!');
                }
            
        }

            $this->title = 'Добавление фото';
            $user = Auth()->user();
            $addPhoto = view('addPhoto')->with('user',$user)->render();
            $addPhoto = $this->vars = array_add($this->vars,'addPhoto',$addPhoto);
            return $this->renderOutput();
        
    }

}
