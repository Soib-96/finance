@if($user)

<!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
            <li class="breadcrumb-item active">Доходы</li>
            <li style="margin-left: 78%;"><a href="" class="btn btn-primary">Категории</a></li>
          </ul>
        </div>
      </div>


       <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display" style="text-align: center;">Доходы</h1>
          </header>
           @if(count($user->incomes))
				
			<div class="row">
            <div class="col-lg-12">
              <form class="form-inline">
                <div class="form-group col-md-12">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Сортировка по категориям</label>
                    <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                        <option selected>Все</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <button type="submit" class="btn btn-primary my-1">Сортировать</button>
                    <a href="{{ route('incomes.create') }}" class="btn btn-default my-1" style="margin-left: 527px;">Добавить</a>
                </div>     
              </form>

              <div style="margin-bottom: 20px"></div>

              <div class="card">
                <div class="card-header">
                  <h4>Таблица доходов</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th>#</th>
                          <th>Название</th>
                          <th>Кошелек</th>
                          <th>Категория</th>
                          <th>Сумма</th>
                          <th>Описание</th>
                        </tr>
                      </thead>
                      <tbody>
						
						        <?php $i=1 ?>
                      	@foreach($user->incomes as $income)
                        	<tr>
                          		<th scope="row">{{ $i }}</th>
                          		<td>{{ $income->title }}</td>
                          		<td>{{ $income->purse->name }}</td>
                          		<td>Зарплата</td>
                          		<td>{{ $income->sum }} <i class="fa {{ $income->purse->currency }}"></td>
                          		<td>{{ $income->description }}</td>
                        	</tr>
                        <?php $i++ ?>
						        @endforeach

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
		@else
			<div style="margin-left: 35%">
              	<h1 style="color: rgb(51, 179, 90); --darkreader-inline-color:#7cda98;" data-darkreader-inline-color=""><i>Вы пока ничего не добавили!</i></h1><i class="far fa-frown"></i>
              	<a style="margin-left: 55px; margin-top: 10px;" href="{{ route('incomes.create') }}" class="btn btn-lg btn-primary">Добавить доход</a>  
            </div>

		@endif
        </div>
      </section>

@endif