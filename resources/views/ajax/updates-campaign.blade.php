@if( $data->count() != 0 )

@foreach ( $data as $update )

	@include('includes.ajax-updates-campaign')
	
@endforeach

{{ $data->links('vendor.pagination.loadmore') }}

@endif
