<?php
$users = \App\User::all();
?>

<div class="col-lg-12">
  

    <h1 class="page-header">Users</h1>
    <h3 class="bg-success text-center">{{ session()->has('userStatus') ? session()->get('userStatus') : "" }}</h3>

    <a href="{{ route('admin.addUser') }}" class="btn btn-primary">Add User</a>

    <div class="col-md-12">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>

                
                @foreach($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    @if($user->id === Auth::id())
                      <td>{{ $user->name." (Current User)" }}</td>
                    @else
                      <td>{{ $user->name }}</td>
                    @endif
                    <td>{{ $user->email }}</td>
                    <td>
                      <div class="action_links">
                        @if($user->id === Auth::id())
                          <span>N/A</span>
                        @else
                          <a href="{{ route('admin.deleteUser', $user->id) }}">Delete</a>
                        @endif
                        
                        <a style="padding-left:20px;" href="{{ route('admin.editUser', $user->id) }}">Edit</a>
                      </div>
                    </td>
                  </tr>
                @endforeach
                
 
            </tbody>
        </table> <!--End of Table-->
    

    </div>
    
</div>