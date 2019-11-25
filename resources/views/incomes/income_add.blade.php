<section class="forms">
    <div class="container-fluid">
        <!-- Page Header-->
        <header> 
            <h1 class="h3 display" style="text-align: center;">
              {{ isset($income->id) ? Lang::get('ru.edit_income').' '.$income->title : Lang::get('ru.add_income') }}
            </h1>
        </header>
        
        <div class="row">
            <div class="col-lg-9">
              <div class="card" style="margin-left: 35%">

                @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                @endif  
                
                <div class="card-body">
                    <p>Поля отмеченные символом *, обязательны к заполнению</p>
                    <form action="{{ isset($income->id) ? route('incomes.update',['income' => $income->id]) : route('incomes.store') }}" method="post">
                      @csrf
                        <div class="form-group">
                            <label>Название</label>
                            <input type="text" name="title" placeholder="Напишите название ..." class="form-control" required value="{{ isset($income->title) ? $income->title : '' }}">
                        </div>

                        <div class="form-group">
                            <label>Сумма</label>
                            <input type="number"  name="sum" placeholder="Напишите сумму..." class="form-control" required value="{{ isset($income->sum) ? $income->sum : '' }}">
                        </div>
                    
                        @if(count($user->categories) > 0)
                        <div class="form-group">
                            <label>Выберите категорию</label>
                            <select name="category_id" id="" class="form-control">
                                                            
                            <option value="{{ isset($income->category->id) ? $income->category->id : '' }}">
                                {{ isset($income->category->name) ? $income->category->name : '' }}
                            </option>
                            
                                @foreach($user->categories as $category)
                                    @if($category->status == 1)
                      	                 <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @else
                        
                        <select name="category_id" id="" class="form-control">
                             <label>Выберите категорию</label>
                             <option value="">Без категории</option>
                        </select>

                        @endif

                        @if(count($user->purses) > 0)
                            <div class="form-group">
                                <label>Выберите кошелек</label>
                                <select name="purse_id" id="" class="form-control">

                                @if(isset($income->id))
                                    <option value="{{ $income->purse->id }}">
                                        {{ $income->purse->name }}
                                    </option>
                                @endif

                                @foreach($user->purses as $purse)
                                   <option value="{{ $purse->id }}">{{ $purse->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <label>Описание</label>
                            <input type="text"  name="description" placeholder="Описание..." class="form-control" value="{{ isset($income->description) ? $income->description : '' }}">
                        </div>
                    
                        @if(isset($income->id))
                            <input type="hidden" name="_method" value="PUT">
                        @endif

                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Отменит</button>       
                            <input type="submit" value="Сохранить" class="btn btn-primary">
                        </div>
                    </form>
              </div>
            </div>
          </div>
        </div>
    </div>
</section>