@extends('app')

@section('title'){{ trans('misc.donate').' Success ' }}@endsection

@section('css')
<link href="{{ asset('public/plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />

<style>
/**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;

  height: 46px;

  padding: 14px 12px;

  border: 1px solid #ccc;
  border-radius: 6px;
  background-color: white;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
	border-color: #f45302;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>

@endsection

@section('content')

<div class="jumbotron md header-donation jumbotron_set">
      <div class="container wrap-jumbotron position-relative">
      	<h2 class="title-site">{{ trans('misc.donate') }}</h2>
      	
      </div>
    </div>
@if(isset($success) && !empty($success))

                                   <h2 class="title-site" style="color:green">Donation Recieved Successfully!</h2>

                                @endif
<div class="container margin-bottom-40 padding-top-40">

<!-- Col MD -->
<div class="col-md-8 margin-bottom-20">

	   <!-- form start -->
    <form method="get" action="{{ route('paynow').'/' }}" enctype="multipart/form-data" id="">

    	


                </form>

 </div><!-- /COL MD -->

@endsection

