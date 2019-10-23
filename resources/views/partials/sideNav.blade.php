<?php
$categories = \DB::table('categories')->get();
?>

<div class="col-md-3">
  <p class="lead">Shop Name</p>
  <div class="list-group">
      @foreach($categories as $category)
        <a href="{{ route('singleCategory', $category->id) }}" class="list-group-item">{{ $category->title }}</a>
      @endforeach
  </div>
</div>