@if($user)
  <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
            <li class="breadcrumb-item active">Кошельки </li>
            @if(count($user->purses) > 0)
              <li style="margin-left: 73%;">
                <a href=

                " class="btn btn-primary">Добавить кошелек</a>
              </li>
            @endif
          </ul>
        </div>
      </div>
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row"> 
            <!-- Count item widget-->

            @if(count($user->purses) > 0)
            @foreach($user->purses as $purse)
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="fa fa-credit-card-alt"></i></div>
                <div class="name"><strong class="text-uppercase" style=""><b>{{ $purse->name }}</b></strong><span>Создан: {{ $purse->created_at->format('d-m-y') }}</span>
                  <h3 class="display-4">{{ $purse->sum.$purse->currency }}<h3>
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