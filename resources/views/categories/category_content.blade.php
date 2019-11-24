@if($user)
<!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Главная</a></li>
            <li class="breadcrumb-item active">Категории</li>
          </ul>
        </div>
      </div>
      
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display" style="text-align: center;">Категории</h1>
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
                <a href="{{ route('categories.create') }}" class="btn btn-default my-1" style="margin-left: 89%;">
                  Добавить
                </a>
            <div style="margin-bottom: 20px"></div>
            
            @if(count($user->categories) > 0)
            <div style="margin-left: 400px;"> 
                <div class="col-lg-6">
                    <ul class="list-group">
                      @foreach($categories as $category)
                        <li class="list-group-item">
                          {{ $category->name }}
                        
                        </li>
                      @endforeach
                    </ul>
                </div>
            </div>

            @else
              <h1>Вы пока не добавили категории</h1>
            @endif

            
            </div>
          </div>
        </div>
      </section>
@endif