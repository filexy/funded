<?php $settings = App\Models\AdminSettings::first(); ?>
@extends('app')

@section('title'){{ e($title) }}@stop

@section('content')

<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site">{{ trans('misc.search') }}</h2>
        <p class="subtitle-site none-overflow"><strong>"{{$q}}"</strong></p>
      </div>
    </div>
    
<div class="container margin-bottom-40">
	<div class="row">
		<div class="col-md-12">
			
			<h2 class="text-center line position-relative none-overflow">
				{{ trans('misc.result_of') }} "{{ $q }}" <small>{{ $total }} {{ trans_choice('misc.campaigns_plural',$total) }}</small>
				</h2>
	
	@if( $data->total() != 0 )		
		<div class="margin-top-30 margin-bottom-30">
			@include('includes.campaigns')
		</div>
		
		@else
		
		<div class="btn-block text-center margin-top-40">
	    			<i class="icon-search ico-no-result"></i>
	    		</div>
	    		
	    		<h3 class="margin-top-none text-center no-result no-result-mg">
	    	{{ trans('misc.no_results_found') }}
	    	</h3>
	    			
		@endif
			
				
	
		</div><!-- col-md-12 -->
	</div><!-- row -->
</div><!-- container -->
@endsection

@section('javascript')
	
	<script type="text/javascript">
		$(document).on('click','#campaigns .loadPaginator', function(r){
			r.preventDefault();
			 $(this).remove();
			 $('.loadMoreSpin').remove();
					$('<div class="col-xs-12 loadMoreSpin"><a class="list-group-item text-center"><i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i></a></div>').appendTo( "#campaigns" );
					
					var page = $(this).attr('href').split('page=')[1];
					$.ajax({
						url: '{{ url("ajax/search") }}?slug={{$q}}&page=' + page,
					}).done(function(data){
						if( data ) {
							$('.loadMoreSpin').remove();
							
							$( data ).appendTo( "#campaigns" );
						} else {
							bootbox.alert( "{{trans('misc.error')}}" );
						}
						//<**** - Tooltip
					});
			});
	</script>
	
@endsection