
<!-- Page Content -->
<div class="col-md-12">

    
    <div class="col-md-4 col-xs-offset-4">
        <h1>Register a User</h1>      
        <form action="{{ route('admin.addUser') }}" method="post" enctype="multipart/form-data">
            {{  csrf_field() }}
            <div  class="form-group"><label for="name">
                Name<input type="name" id="name" name="name" class="form-control"></label>
            </div>

            <div class="form-group"><label for="email">
                Email<input type="email" id="email" name="email" class="form-control"></label>
            </div>

            <div class="form-group"><label for="password">
                Password<input type="text" id="password" name="password" class="form-control"></label>
            </div>

            <div class="form-group">
              <input type="submit" name="submit" class="btn btn-primary" >
            </div>
        </form>
    </div>

</div>
<!-- /.container -->