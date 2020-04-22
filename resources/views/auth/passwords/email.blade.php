<?php $settings = App\Models\AdminSettings::first(); ?>
@extends('app')

@section('title')
{{ trans('auth.password_recover') }} -
@endsection

@section('content')

<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site">{{ trans('auth.password_recover') }}</h1>
        <p class="subtitle-site"><strong>{{$settings->title}}</strong></p>
      </div>
    </div>

<div class="container-fluid margin-bottom-40">
	<div class="row">
		<div class="col-md-12">

			<h2 class="text-center line position-relative">{{ trans('auth.password_recover') }}</h2>

	<div class="login-form">

		@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif


		@include('errors.errors-forms')

          	<form action="{{ url('/password/email') }}" method="post" name="form" id="signup_form">
            {{ csrf_field() }}

            @if($settings->captcha == 'on')
              @captcha
            @endif

            <div class="form-group has-feedback">

              <input type="text" value="{{ old('email') }}" class="form-control login-field custom-rounded" name="email" id="email" placeholder="{{ trans('auth.email') }}" title="{{ trans('auth.email') }}" autocomplete="off">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
             </div>

           <button type="submit" id="buttonSubmit" class="btn btn-block btn-lg btn-main custom-rounded btn-auth">{{ trans('auth.send') }}</button>
				<a href="{{ url('login') }}" class="text-center btn-block margin-top-10 back_btn"><i class="fa fa-long-arrow-left"></i> {{ trans('auth.back') }}</a>
          </form>
     </div><!-- Login Form -->

		</div><!-- col-md-12 -->
	</div><!-- row -->
</div><!-- container -->
@endsection

@section('javascript')
	<script src="{{ asset('public/plugins/iCheck/icheck.min.js') }}"></script>

	<script type="text/javascript">

	$('#email').focus();

    @if (count($errors) > 0)
    	scrollElement('#dangerAlert');
    @endif

</script>
@endsection
