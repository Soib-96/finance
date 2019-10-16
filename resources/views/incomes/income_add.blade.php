<section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display" style="text-align: center;">Добавление дохода</h1>
          </header>
          <div class="row">
            <div class="col-lg-9">
              <div class="card" style="margin-left: 35%">
<!--                 <div class="card-header d-flex align-items-center">
  <h4>Rajabov Soib</h4>
</div> -->
                <div class="card-body">
                  <p>Поля отмеченные символом *, обязательны к заполнению</p>
                  <form action="{{ route('incomes.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label>Название</label>
                      <input type="text" name="title" placeholder="Напишите название ..." class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label>Сумма</label>
                      <input type="number"  name="sum" placeholder="Напишите сумму..." class="form-control" required>
                    </div>
                    
                    @if(count($user->categories) > 0)
                    <div class="form-group">
                      <label>Выберите категорию</label>
                      <select name="category_id" id="" class="form-control">
                        @foreach($user->categories as $category)
                          @if($category->status == 1)
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
                        @foreach($user->purses as $purse)
        
                           <option value="{{ $purse->id }}">{{ $purse->name }}</option>

                        @endforeach
                      </select>
                    </div>
                    @endif

                    <div class="form-group">
                      <label>Описание</label>
                      <input type="text"  name="description" placeholder="Описание..." class="form-control">
                    </div>


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