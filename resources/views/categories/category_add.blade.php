<section class="forms">
    <div class="container-fluid">
        <!-- Page Header-->
        <header> 
            <h1 class="h3 display" style="text-align: center;">
                 Добавить
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
                    <form action="{{ route('categories.store') }}" method="post">
                      @csrf
                        

                        <div class="form-group">
                            <label>Тип категории *</label>
                            <select name="status" id="" class="form-control">
                                    <option value="1">
                                        Категория для дохода
                                    </option>
                                    <option value="2">
                                       Категория для расхода
                                    </option>
                            </select>
                        </div>
                        
                         <div class="form-group">
                            <label>Название *</label>
                            <input type="text"  name="name" class="form-control" value="" required>
                        </div>

                    
                        @if(isset($expense->id))
                            <input type="hidden" name="_method" value="PUT">
                        @endif

                        <div class="form-group">       
                            <input type="submit" value="Сохранить" class="btn btn-primary">
                        </div>
                    </form>
              </div>
            </div>
          </div>
        </div>
    </div>
</section>