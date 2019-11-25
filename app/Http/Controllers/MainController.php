<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Menu;
use App\Purse;

class MainController extends Controller
{

    protected $title;
    protected $content;
    protected $user;

    protected $template;
    protected $vars;

    protected $contentRightBar=FALSE;

    protected $contentLeftBar=FALSE;


    public function __construct()
    {

    }

    public function renderOutput()
    {

    	$this->vars = array_add($this->vars,'title', $this->title);

        $menus = $this->getMenu();
        //dd($menus);

        $user = Auth()->user();

    	$navigation = view("navigation")->with(['menus',$menus,'user'=>$user])->render();
        $this->vars = array_add($this->vars,'navigation', $navigation);


        if ($this->contentRightBar) {

            $rightBar = $this->contentRightBar;

            $this->vars = array_add($this->vars,'rightBar', $rightBar);
        }

        if ($this->content) {

        	$content = $this->content;
        	$this->vars = array_add($this->vars,'content',$this->content);
        }

        $footer = view("footer")->render();
        $this->vars = array_add($this->vars,'footer', $footer);

        return view($this->template)->with($this->vars);

    }

    public function getPurse($id)
    {
        $purse = Purse::find($id);
        return $purse;
    }

    // assignment value to foreign keys income table
    public function assigment($income,$user,$data)
    {
        $income->user_id = $user;

        if (isset($data['category_id']))
        {
            $income->category_id = $data['category_id'];
        }else
        {
            $income->category_id = NULL;
        }

        $income->purse_id = $data['purse_id'];
        return $income;
    }

    public function getMenu()
    {
        return Menu::make('NavMenu',function($menu){

            $menu->add('Главная',array(['route' => 'index','id'=>1,'parent'=>0]));
           // $menu->add('Харкатеристика',array('route' => 'adminMenus.index'));
            $menu->add('Кошельки',array(['route' => 'index','id'=>2,'parent'=>0]));
            $menu->add('Доходы',array(['route' => 'index','id'=>3,'parent'=>0]));
            $menu->add('Расходы',array(['route' => 'index','id'=>4,'parent'=>0]));
            $menu->add('Дольги',array(['route' => 'index','id'=>5,'parent'=>0]));
            $menu->add('Личные данные',array(['route' => 'index','id'=>6,'parent'=>0]));
            $menu->add('Изменить',array(['route' => 'index','id'=>7,'parent'=>6]));
            $menu->add('Выйти',array(['route' => 'index','id'=>8,'parent'=>6]));

           // $menu->add('Привилегии',array('route' => 'home'));
        });
    }

}
