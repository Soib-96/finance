 @if($user)
 <!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row">
            <!-- Count item widget-->
          
          @if(count($user->purses) > 0)
            @foreach($user->purses as $purse)

            <div class="col-xl-3 col-md-4 col-6" style="margin-bottom: 15px;">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="fa fa-credit-card-alt"></i></div>
                <div class="name"><strong class="text-uppercase" style=""><b>{{ $purse->name }}</b></strong><span>Создан: {{ $purse->created_at->format('d-m-y') }}</span>
                  <h3>{{ $purse->sum }} <i class="fa {{ $purse->currency->icon }}" aria-hidden="true"></i><h3>
                </div>
              </div>
            </div>
            

            @endforeach

          @else
            
            <h1 style="color:#33B35A;"><i>У вас пока нет кошельков!</i></h1><i class="far fa-frown"></i>



          @endif
          </div>
        </div>
      </section>
@endif


<!-- Header Section-->
      <section class="dashboard-header section-padding">
        <div class="container-fluid">
          <div class="row d-flex align-items-md-stretch">
            <!-- To Do List-->

            @if($user)
            <div class="col-lg-3 col-md-6">
              <div class="card to-do">
                <h2 class="display h4">Последние расходы</h2>
               <!--  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                <ul class="check-lists list-unstyled">

                  @foreach($user->expenses as $expense)
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-1" name="list-1" class="form-control-custom">
                    <label for="list-1">{{ $expense->title }}</label>
                  </li>
                  @endforeach
              
                </ul>
              </div>
            </div>
            @endif
            <!-- Pie Chart-->
            <div class="col-lg-3 col-md-6">
              <div class="card project-progress">
                <h2 class="display h4">Статистика</h2>
                <!-- <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                <div class="pie-chart">
                  <canvas id="pieChart" width="300" height="300"> </canvas>
                </div>
              </div>
            </div>
            <input type="hidden" name="incomes" value="{{ $user->incomes->sum('sum') }}">
            <input type="hidden" name="expenses" value="{{ $user->expenses->sum('sum') }}">
            <input type="hidden" name="debts" value="{{ $user->debts->sum('sum') }}">
            <!-- Line Chart -->
           @if($user)
            <div class="col-lg-3 col-md-6">
              <div class="card to-do">
                <h2 class="display h4">Последние доходы</h2>
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                <ul class="check-lists list-unstyled">

                  @foreach($user->incomes as $income)
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-1" name="list-1" class="form-control-custom">
                    
                    <label for="list-1">{{ $income->title }}</label>
                  </li>
                  @endforeach
              
                </ul>
              </div>
            </div>
            @endif
          </div>
        </div>
      </section>