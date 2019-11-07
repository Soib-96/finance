
<section class="forms">
    <div class="container-fluid">
       
        <header> 
            <h1 class="h3 display" style="text-align: center;">
                {{ isset($purse->id) ? Lang::get('ru.edit_purses').' '.$purse->name : Lang::get('ru.add_purses') }}
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
              <form action="{{ isset($purse) ?  
                    route('purses.update',['purses'=>$purse->id]) : route('purses.store') }}" method="post">
              @csrf
                  
                  <div class="form-group">
                      <label>Название</label>
                      <input type="text" name="name" placeholder="Напишите название ..." class="form-control" required value="{{ isset($purse->name) ? $purse->name : '' }}">
                  </div>

                  <div class="form-group">
                      <label>Сумма</label>
                      <input type="number"  name="sum" placeholder="Напишите сумму..." class="form-control" required value="{{ isset($purse->sum) ? $purse->sum : '' }}">
                  </div>
                    
                  <div class="form-group">
                      <label>Выберите валюту</label>
                      
                      <select name="currency_id" id="" class="form-control">    
                          @if(isset($purse->id))
                            <option value="{{ $purse->currency->id }}">
                              {{ $purse->currency->name }}
                            </option>
                          @endif

                          @foreach($currencies as $currency)
                            <option value="{{ $currency->id }}">
                              {{ $currency->name }}
                            </option>
                          @endforeach
                      </select>

                  </div>
                    
                   
                    <!-- <div class="form-group">
                      <label>Выберите иконку</label>
                    </div> -->
                    
                  @if(isset($purse->id))
                      <input type="hidden" name="_method" value="PUT">
                  @endif
                    
                  <div class="form-group">
                      <button type="submit" class="btn btn-secondary">Отменит</button>       
                      <input type="submit" value="Добавить" class="btn btn-primary">
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>