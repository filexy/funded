@if( $data->count() != 0 )
@foreach ( $data as $key )
    @include('includes.list-campaigns')
@endforeach
@if( $data->hasMorePages() )
<div class="col-xs-12 loadMoreSpin">
	@if( isset($slug) )
	{{ $data->appends( array( 'slug' => $slug ) )->links('vendor.pagination.loadmore') }}
	@else
	{{ $data->links('vendor.pagination.loadmore') }}
	@endif
</div>
@endif
@endif