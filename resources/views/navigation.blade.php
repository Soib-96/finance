<!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        
        <!-- User Info-->
        @if($user)
            
            <div class="sidenav-header d-flex align-items-center justify-content-center">
                <div class="sidenav-header-inner text-center">
            
                  @if(isset($user->images))
                    
                      <a href="{{ route('addPhoto',['user'=>$user->id]) }}"data-toggle="tooltip" data-placement="top" title="Изменить изображение">
                          <img src="/assets/img/users/{{ $user->images }}" alt="{{ $user->name }}" class="img-fluid rounded-circle">
                      </a>

                  @else
                      <a href="{{ route('addPhoto',['user'=>$user->id]) }}"data-toggle="tooltip" data-placement="top" title="Добавить изображение">
                        <img src="/assets/img/users/photo_default.png" alt="{{ $user->name }}" class="img-fluid rounded-circle">
                      </a>
                  @endif
                      <h2 class="h5">{{ $user->name }}</h2><span>Web Developer</span>
                </div>
                
                <!-- Small Brand information, appears on minimized sidebar-->
                <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>{{ substr($user->name, 0,1) }}</strong><strong class="text-primary">D</strong></a></div>
            </div>
        @endif
        

        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Меню</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">  
            
            <li class="{{ (Route::currentRouteName() == 'index') ? 'active' : '' }}"><a href="{{ route('index') }}"> <i class="icon-home"></i>Главная</a></li>
            
            <li class="{{ (Route::currentRouteName() == 'purses.index') || (Route::currentRouteName() == 'purses.create') ? 'active' : '' }}">
              <a href="{{ route('purses.index') }}"> 
                <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                    Кошельки
              </a>
            </li>
            
            <li class="{{ (Route::currentRouteName() == 'incomes.index') || (Route::currentRouteName() == 'incomes.create') ? 'active' : '' }}"><a href="{{ route('incomes.index') }}"> <i class="fa fa-bar-chart"></i>Доходы</a></li>
            
            <li class="{{ (Route::currentRouteName() == 'expenses.index') || (Route::currentRouteName() == 'expenses.create') ? 'active' : '' }}">
              <a href="{{ route('expenses.index') }}">
                  <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                    Расходы
              </a>
            </li>
            
            <li>
              <a href="arrears.html"><i class="fa fa-tasks" aria-hidden="true"></i>
                  Дольги
              </a>
            </li>
            
            <li><a href="tables.html"> <i class="icon-grid"></i>Переводы</a></li>
            
            <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Личные данные</a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="change.html">Изменить</a></li>
                <li><a href="login.html">Выйти</a></li>
              </ul>
            </li>
          
          </ul>
        </div>
      </div>
    </nav>
    <div class="page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><span>Личный финансовый учёт</span><!-- <strong class="text-primary"> Dashboard</strong> --></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Notifications dropdown-->
               
                <li class="nav-item">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                     Выход
                     <i class="fa fa-sign-out"></i>
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                  </form></li>
                
                <!-- Log out-->
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <!-- Counts Section -->