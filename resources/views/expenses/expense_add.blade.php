<section class="forms">
    <div class="container-fluid">
        <!-- Page Header-->
        <header> 
            <h1 class="h3 display" style="text-align: center;">
              {{ 
                isset($expense->id) ? Lang::get('ru.edit_expense').' '.$expense->title : Lang::get('ru.add_expense') 
              }}
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
                    <form action="{{ isset($expense->id) ? route('expenses.update',['expense' => $expense->id]) : route('expenses.store') }}" method="post">
                      @csrf
                        <div class="form-group">
                            <label>Название</label>
                            <input type="text" name="title" placeholder="Напишите название ..." class="form-control" required value="{{ isset($expense->title) ? $expense->title : '' }}">
                        </div>

                        <div class="form-group">
                            <label>Сумма</label>
                            <input type="number"  name="sum" placeholder="Напишите сумму..." class="form-control" required value="{{ isset($expense->sum) ? $expense->sum : '' }}">
                        </div>
                    
                        @if(count($user->categories) > 0)
                        <div class="form-group">
                            <label>Выберите категорию</label>
                            <select name="category_id" id="" class="form-control">
                                @if(isset($expense->id))
                                    <option value="{{ $expense->category->id }}">
                                        {{ $expense->category->name }}
                                    </option>
                                @endif
                        
                                @foreach($user->categories as $category)
                                    @if($category->status == 2)
                      	                 <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @endif

                        @if(count($user->purses) > 0)
                            <div class="form-group">
                                <label>Выберите кошелек</label>
                                <select name="purse_id" id="" class="form-control">

                                @if(isset($expense->id))
                                    <option value="{{ $expense->purse->id }}">
                                        {{ $expense->purse->name }}
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
                            <input type="text"  name="description" placeholder="Описание..." class="form-control" value="{{ isset($expense->description) ? $expense->description : '' }}">
                        </div>
                    
                        @if(isset($expense->id))
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