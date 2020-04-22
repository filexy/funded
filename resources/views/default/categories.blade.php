@extends('app')

@section('title'){{ trans('misc.categories').' - ' }}@endsection

@section('content') 
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site">{{ trans('misc.categories') }}</h2>
        <p class="subtitle-site"><strong>{{trans('misc.browse_by_category')}}</strong></p>
      </div>
    </div>

<div class="container margin-bottom-40">
	
	    		@foreach ($data as $category)
	        				@include('includes.categories-listing')
	        			@endforeach

 </div><!-- container wrap-ui -->
@endsection

