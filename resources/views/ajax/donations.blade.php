@if( $data->count() != 0 )
@foreach ( $data as $donation )
    <?php 
    $letter = str_slug(mb_substr( $donation->fullname, 0, 1,'UTF8')); 
    
	if( $letter == '' ) {
		$letter = 'N/A';
	} 
	
	if( $donation->anonymous == 1 ) {
		$letter = 'N/A';
		$donation->fullname = trans('misc.anonymous');
	}
    ?>

	@include('includes.listing-donations')

@endforeach
{{ $data->links('vendor.pagination.loadmore') }}
@endif
