  <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Изменение личные данные</h1>
          </header>
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>{{ $user->name }}</h4>
                </div>
                <div class="card-body">
                  <!-- <p>Lorem ipsum dolor sit amet consectetur.</p> -->
                  <form>
                    <div class="form-group">
                      <label>Имя и фамилия</label>
                      <input type="text" placeholder="Email Address" class="form-control" required value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" placeholder="Email адрес" class="form-control" required value="{{ $user->email }}">
                    </div>

                    <div class="form-group">       
                      <label>Текущий пароль</label>
                      <input type="password" placeholder="Текущий пароль" class="form-control" required>
                    </div>
                    
                    <div class="form-group">       
                      <label>Пароль</label>
                      <input type="password" placeholder="Пароль" class="form-control" required>
                    </div>

                    <div class="form-group">       
                      <label>Подтвердите пароль</label>
                      <input type="password" placeholder="Подтвердите пароль" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-secondary">Отменит</button>       
                      <input type="submit" value="Изменить" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                   
                   <div class="col-md-4">
                      <img src="/assets/img/users/{{ $user->images }}" class="card-img" alt="...">
                     
                      	{!!Form::open(['url' => 
                            route('deleteUser',['user_id'=>$user->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
                            {{ method_field('DELETE') }}
                            {!! Form::button('Удалить аккаунт',['class'=> 'btn btn-danger','style'=>'margin: 10px;','type'=>'submit' ]) !!}
                        {!! Form::close() !!}
                   </div>
                
                   <div class="col-md-8">
                      <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Всего доходов
                              <span class="badge badge-primary badge-pill">
                              	{{ $user->incomes->sum('sum') }}
                              </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Всего расходов
                              <span class="badge badge-primary badge-pill">	
                              	{{ $user->expenses->sum('sum') }}
                              </span>
                            </li>
                        </ul>
                        <p class="card-text"><small class="text-muted">Дата регистрации на сайте: {{ $user->created_at->format('d-m-Y') }}</small></p>
                      </div>
                   </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>