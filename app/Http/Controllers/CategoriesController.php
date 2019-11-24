<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends MainController
{

    public function __construct()
    {
        $this->template = 'categories.category_view';
    }

    // page for show categories
    public function index()
    {
        $this->title = 'Категории';
        $user = Auth::user();

        $back_route = app('router')->getRoutes()->match(app('request')->create(redirect()->back()->getTargetUrl()));
        $back_route_name = $back_route->getName();

        if ($back_route_name == 'incomes.index')
        {
            $categories = Category::where(['status'=>1,'user_id'=>$user->id])->get();

        }elseif($back_route_name == 'expenses.index')
            {
                $categories = Category::where(['status'=>2,'user_id'=>$user->id])->get();
            }


        $this->content = view('categories.category_content')->with(['user'=>$user,
                                                                          'categories' => $categories]);
        return $this->renderOutput();
    }

    // page for add categories
    public function create()
    {
        $this->title = 'Категории';
        $user = Auth::user();
        $this->content = view('categories.category_add');
        return $this->renderOutput();
    }

    // add cateogories in database
    public function store(Request $request)
    {
        $user = Auth::user()->id;
        $data = $request->except('_token');

        $category = new Category();

        $category->user_id = $user;

        $category->fill($data);

        if ($category->save())
        {
            if ($data['status'] == 1)
            {
                return redirect('/incomes')->with('status','Категория добавлена');
            }else
                {
                    return redirect('/expenses')->with('status','Категория добавлена');
                }
        }
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
        //
    }
}
