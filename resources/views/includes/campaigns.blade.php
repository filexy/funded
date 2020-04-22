<div class="posts" id="posts" style="padding-top: 15px;">
	<div class="row" id="campaigns">
   @foreach ( $data as $key )
    	@include('includes.list-campaigns')
    	  @endforeach
    	 <div class="col-xs-12 loadMoreSpin">
    	 		{{ $data->links('vendor.pagination.loadmore') }}
    	 </div>
    	 </div><!-- /row -->
 </div><!-- ./ End Posts -->