<span class="description margin-bottom-20 btn-block">
	<strong>#{{trans('misc.update')}}</strong> 
	@if( Auth::check() && Auth::user()->id == $update->campaigns()->user_id )
		<a href="{{url('edit/update',$update->id)}}" class="btn btn-success btn-xs"><i class="fa fa-pencil mycion-right"></i> {{trans('users.edit')}}</a>
	@endif
	<small class="btn-block timeAgo text-muted" style="font-size: 15px; font-style: italic;" data="{{ date('c', strtotime( $update->date )) }}"></small>
		{!!App\Helper::checkText($update->description)!!}
		@if( $update->image !== '' )	
		<span class="text-center btn-block">
			<img class="img-responsive img-rounded  margin-top-10" style="display: inline-block;" src="{{url('public/campaigns/updates',$update->image)}}" />
		</span>
			@endif
</span>