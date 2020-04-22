<?php $settings = App\Models\AdminSettings::first(); ?>
@extends('app')

@section('title'){{ trans('misc.likes').' - ' }}@endsection

@section('content') 
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site">{{ trans('misc.likes') }}</h2>
        </div>
    </div>

<div class="container margin-bottom-40">
	
<!-- Col MD -->
<div class="col-md-12 margin-top-20 margin-bottom-20">	

	@if( $data->total() != 0 )	

			<div class="row" id="campaigns">
		   @foreach ( $data as $key )
		    	@include('includes.list-campaigns')
		    	  @endforeach
		 
		 @if( $data->lastPage() > 1 )
		    <div class="col-md-12">
		    	<hr />
   		  		 {{ $data->links() }}
		    </div>
		    @endif
		    	
		    	 
		    	 </div><!-- /row -->	     			    		 
	  @else
	  <div class="btn-block text-center">
	    			<i class="icon-search ico-no-result"></i>
	    		</div>
	    		
	    		<h3 class="margin-top-none text-center no-result no-result-mg">
	    		{{ trans('misc.no_results_found') }}
	    	</h3>
	  @endif
	    	
     </div><!-- /COL MD -->
 </div><!-- container wrap-ui -->
@endsection