@if($user)
<!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Главная</a></li>
            <li class="breadcrumb-item active">Долги</li>
            <li style="margin-left: 78%;"><a href="" class="btn btn-primary">Категории</a></li>
          </ul>
        </div>
      </div>
      
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display" style="text-align: center;">Долги</h1>
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
                    <a href="{{ route('debts.create') }}" class="btn btn-default my-1" style="margin-left: 89%;">Добавить</a>
              <div style="margin-bottom: 20px"></div>

              <div class="card">
                
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Тип долга</th>
                              <th scope="col">Кто/Кому</th>
                              <th scope="col">Сколько</th>
                              <th scope="col">Кошелек</th>
                              <th scope="col">Действие</th>

                            </tr>
                        </thead> 

                        <tbody>
                          @foreach($user->debts as $debt)
                            @if($debt->type == 1)
                            <tr class="table-primary">
                              <th scope="col">Вам должны</th>
                              <th scope="col">{{ $debt->name }}</th>
                              <th scope="col">{{ $debt->sum }}</th>
                              <th scope="col">{{ $debt->purse->name }}</th>
                              <th scope="col">
                                  {!!Form::open(['url' => 
                                    route('debts.destroy',['debt' =>  $debt->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
                                    {{ method_field('DELETE') }}
                                {!! Form::button('Погашение',['class'=> 'btn btn-success','type'=>'submit' ]) !!}
                                {!! Form::close() !!}
                              </th>
                            </tr>
                            @elseif($debt->type == 2)
                            <tr class="table-danger">
                              <th scope="col">Вы должны</th>
                              <th scope="col">{{ $debt->name }}</th>
                              <th scope="col">{{ $debt->sum }}</th>
                              <th scope="col">{{ $debt->purse->name }}</th>
                              <th scope="col">
                                {!!Form::open(['url' => 
                                    route('debts.destroy',['debt' =>  $debt->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
                                    {{ method_field('DELETE') }}
                                {!! Form::button('Погашение',['class'=> 'btn btn-danger','type'=>'submit' ]) !!}
                                {!! Form::close() !!}
                              </th>
                            </tr>
                            @endif
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