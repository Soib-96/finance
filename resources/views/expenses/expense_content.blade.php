 @if($user)
 <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Главная</a></li>
            <li class="breadcrumb-item active">Расходы</li>
            <li style="margin-left: 78%;"><a href="" class="btn btn-primary">Категории</a></li>
          </ul>
        </div>
      </div>

      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display" style="text-align: center;">Расходы</h1>
          </header>
          <div class="row">

          	@if(session('status'))
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">
                        {!! session('status') !!} 
                    </div>
                </div>
            @endif
            
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
                    <a href="{{ route('expenses.create') }}" class="btn btn-default my-1" style="margin-left: 527px;">Добавить</a>
                </div>     
              </form>

              <div style="margin-bottom: 20px"></div>

              <div class="card">
                <div class="card-header">
                  <h4>Таблица расходов</h4>
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
                          <th>Дата</th>
                          <th>Действие</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php $i=1 ?>
                      	@foreach($user->expenses as $expense)
                        <tr>
                          <th scope="row">{{ $i }}</th>
                          <td>
                          	<a href="{{ route('expenses.edit',['expense'=>$expense->id]) }}">{{ $expense->title }}</a>
                          </td>
                          <td>{{ $expense->purse->name }}</td>
                          <td>{{ $expense->category->name }}</td>
                          <td>{{ $expense->sum }}</td>
                          <td>{{ $expense->description }}</td>
                          <td>{{ $expense->created_at->format('d-m-Y') }}</td>
                          <td>
                                {!!Form::open(['url' => 
                                    route('expenses.destroy',['expense' =>  $expense->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
                                    {{ method_field('DELETE') }}
                                {!! Form::button('Удалить',['class'=> 'btn btn-danger','type'=>'submit' ]) !!}
                                {!! Form::close() !!}
                           </td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
@endif