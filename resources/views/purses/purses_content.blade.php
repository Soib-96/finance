@if($user)
  <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
            <li class="breadcrumb-item active">Кошельки </li>
            @if(count($user->purses) > 0)
              <li style="margin-left: 73%;">
                <a href="{{ route('purses.create') }}" class="btn btn-primary">Добавить кошелек</a>
              </li>
            @endif
          </ul>
        </div>
      </div>

      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row"> 
            <!-- Count item widget-->
            
            @if(session('status'))
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">
                        {!! session('status') !!} 
                    </div>
                </div>
            @endif

           @if(count($user->purses) > 0)
              @foreach($user->purses as $purse)
                  <div class="col-xl-3 col-md-4 col-6" style="margin-bottom: 15px;">
                      <div class="wrapper count-title d-flex">
               
                          <a href="{{ route('purses.edit',['purse'=>$purse->id]) }}">
                              <div class="icon"><i class="fa fa-credit-card-alt"></i></div>
                                  <div class="name">
                                    <strong class="text-uppercase" style=""><b>{{ $purse->name }}</b></strong>
                          </a>

                          <span>Создан: {{ $purse->created_at->format('d-m-y') }}</span>
                          
                          <h3>{{ $purse->sum }}
                              <i class="fa {{ $purse->currency->icon }}" aria-hidden="true"></i>
                          <h3>
                          
                          {!!Form::open(['url' => 
                                                route('purses.destroy',['purse' =>  $purse->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
                                                {{ method_field('DELETE') }}
                          {!! Form::button('Удалить',['class'=> 'btn btn-danger','type'=>'submit' ]) !!}
                          {!! Form::close() !!}
                      </div>
                  </div>
                </div>
            @endforeach


          @else
            
            <div style="margin-left: 35%">
                <h1 style="color:#33B35A;"><i>У вас пока нет кошельков!</i></h1><i class="far fa-frown"></i>
                <a style="margin-left: 55px; margin-top: 10px;" href="{{ route('purses.create') }}" class="btn btn-lg btn-primary">Создайте новый</a>  
            </div>
            
          @endif
            <!-- Count item widget-->
            
          </div>
        </div>
      </section>
@endif