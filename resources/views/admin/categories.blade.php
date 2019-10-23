<?php
$categories = \App\Category::all();
?>
<h1 class="page-header">Product Categories</h1>
<h3 class="bg-success text-center">{{ session()->has('catStatus') ? session()->get('catStatus') : "" }}</h3>
<div class="col-md-4">
    
    <form action="{{ route('admin.categories') }}" method="post">
    {{ csrf_field() }}
    
        <div class="form-group">
            <label for="category-title">Title</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Add Category">
        </div>      

    </form>

</div>


<div class="col-md-8">

    <table class="table">
      <thead>

        <tr>
            <th>id</th>
            <th>Title</th>
        </tr>
      </thead>

      <tbody>
      @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->title }}</td>
            <td><a class="btn btn-danger" href="{{ route('admin.deleteCat', $category->id) }}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
      @endforeach
      </tbody>

    </table>

</div>