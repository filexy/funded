<?php $settings = App\Models\AdminSettings::first(); ?>
@extends('app')

@section('title'){{trans('misc.featured_campaigns').' - ' }}@endsection

@section('content')
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site">{{ trans('misc.featured_campaigns') }}</h2>
        	<p class="subtitle-site"><strong>{{trans('misc.featured_campaigns_subtitle')}}</strong></p>
      </div>
    </div>

<div class="container margin-bottom-40">

<!-- Col MD -->
<div class="col-md-12 margin-top-20 margin-bottom-20">

	@if( $data->total() != 0 )

	     @include('includes.campaigns')

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

@section('javascript')
	<script src="{{ asset('public/plugins/jquery.counterup/jquery.counterup.min.js') }}"></script>
	<script src="{{ asset('public/plugins/jquery.counterup/waypoints.min.js') }}"></script>

		<script type="text/javascript">

		$(document).on('click','#campaigns .loadPaginator', function(r){
			r.preventDefault();
			 $(this).remove();
			 $('.loadMoreSpin').remove();
					$('<div class="col-xs-12 loadMoreSpin"><a class="list-group-item text-center"><i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i></a></div>').appendTo( "#campaigns" );

					var page = $(this).attr('href').split('page=')[1];
					$.ajax({
						url: '{{ url("ajax/campaigns/featured") }}?page=' + page,
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
