<section class="forms">
    <div class="container-fluid">
        <!-- Page Header-->
        <header> 
            <h1 class="h3 display" style="text-align: center;">
              {{ 
                isset($debt->id) ? Lang::get('ru.edit_expense').' '.$debt->title : Lang::get('ru.add_debts') 
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
                    <form action="{{ isset($debt->id) ? route('debts.update',['debt' => $debt->id]) : route('debts.store') }}" method="post">
                      @csrf
                        

                        <div class="form-group">
                            <label>Тип долга</label>
                            <select name="type" id="" class="form-control">
                                    <option value="1">
                                        Дать в долг
                                    </option>
                                    <option value="2">
                                        Взять в долг
                                    </option>
                            </select>
                        </div>
                        
                         <div class="form-group">
                            <label>Кому</label>
                            <input type="text"  name="name" placeholder="Описание..." class="form-control" value="{{ isset($debts->name) ? $debts->name : '' }}" required>
                        </div>

                        <div class="form-group">
                            <label>Сумма</label>
                            <input type="number"  name="sum" placeholder="Напишите сумму..." class="form-control" required value="{{ isset($debts->sum) ? $debts->sum : '' }}">
                        </div>
 
                        @if(count($user->purses) > 0)
                            <div class="form-group">
                                <label>Выберите кошелек</label>
                                <select name="purse_id" id="" class="form-control">

                                @if(isset($debts->id))
                                    <option value="{{ $expense->purse->id }}">
                                        {{ $debts->purse->name }}
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
                            <input type="text"  name="description" placeholder="Описание..." class="form-control" value="{{ isset($debts->description) ? $debts->description : '' }}">
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