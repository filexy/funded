<?php
$default   = url('public/avatar/default.jpg');
$size       = 40;
$gravatar = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $donation->email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

if( $donation->anonymous == 0 ) {
	$gravatar = $gravatar;
} else {
	$gravatar = $default;
}

?>
<li class="list-group-item">
       	<div class="media">
			  <div class="media-left">
			      <img class="media-object img-circle imgDonations" src="{!!$gravatar!!}"  width="40" height="40">
			  </div>
			  <div class="media-body">
			    <h4 class="media-heading">{{$donation->fullname}}</h4>
			    <span class="btn-block recent-donation-amount font-default">
			    	{{App\Helper::amountFormat($donation->donation)}}
			    </span>
			    @if( $donation->comment != '' )
			    <p class="margin-bottom-5">{{$donation->comment}}</p>
			    @endif
			    <small class="btn-block timeAgo text-muted" data="{{ date('c', strtotime( $donation->date )) }}"></small>
			  </div>
		</div>
</li>
