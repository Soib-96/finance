<section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display" style="text-align: center;">Добавление нового кошелка</h1>
          </header>
          <div class="row">
            <div class="col-lg-9">
              <div class="card" style="margin-left: 35%">
<!--                 <div class="card-header d-flex align-items-center">
  <h4>Rajabov Soib</h4>
</div> -->
                <div class="card-body">
                  <p>Поля отмеченные символом *, обязательны к заполнению</p>
                  <form action="{{ route('purses.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label>Название</label>
                      <input type="text" name="name" placeholder="Напишите название ..." class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label>Сумма</label>
                      <input type="number"  name="sum" placeholder="Напишите сумму..." class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label>Выберите валюту</label>
                      <select name="currency" id="" class="form-control">
                      	<option value="руб">руб</option>
                        <option value="$">$</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Выберите иконку</label>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-secondary">Отменит</button>       
                      <input type="submit" value="Добавить" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>