<?php 
 if( $category->image == '' ) {
$_image = 'default.jpg';
 } else {
 	$_image = $category->image;
 }
 ?>								
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 row-margin-20">
<a href="{{ url('category',$category->slug) }}">
  <img class="img-responsive btn-block custom-rounded" src="{{asset('public/img-category')}}/{{ $_image }}" alt="{{ $category->name }}">
</a>

<h1 class="title-services">
	<a href="{{ url('category',$category->slug) }}">
		{{ $category->name }} ({{$category->campaigns()->count()}})
	</a>
	</h1>
  </div><!-- col-md-3 row-margin-20 -->