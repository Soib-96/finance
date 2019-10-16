<div class="container">
	
	<div class="row">
		<div>
		</div>
	     <div style="margin-left: 30%; margin-top: 10%">
	     	<main role="main" class="inner cover">

	     		<img style="margin-left: 120px; margin-bottom: 30px;" src="{{ isset($user->images) ? '/assets/img/users/'.$user->images : '/assets/img/users/photo_default.png' }}" width="180px;" height="180px;" alt="Ирина" class="img-fluid rounded-circle mCS_img_loaded"><br>
                
               <form method="post" action="{{ route('addPhoto',['images'=>$user->id]) }}" enctype="multipart/form-data">
                	
                	@csrf
                	<input type="file" name="images" class="btn btn-lg btn-success btn-file" required=""><br>
                    <input type="submit" style="margin-top: 10px; margin-left: 100px;" name="go" class="btn btn-lg btn-warning" value="Сохранить изменения">

               </form>


            </main>
	     </div>
    </div>


</div>