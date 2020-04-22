<?php
// ** Data User logged ** //
     $user = Auth::user();
	  ?>
@extends('app')

@section('title') {{ trans('users.account_settings') }} - @endsection

@section('content')
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site">{{ trans('users.account_settings') }}</h2>
      </div>
    </div>

<div class="container margin-bottom-40">

			<!-- Col MD -->
		<div class="col-md-8 margin-bottom-20">

			@if (session('notification'))
			<div class="alert alert-success btn-sm alert-fonts" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            		{{ session('notification') }}
            		</div>
            	@endif

			@include('errors.errors-forms')



		<!-- *********** AVATAR ************* -->

		<form action="{{url('upload/avatar')}}" method="POST" id="formAvatar" accept-charset="UTF-8" enctype="multipart/form-data">
    		<input type="hidden" name="_token" value="{{ csrf_token() }}">

    		<div class="text-center">
    			<img src="{{ asset('public/avatar').'/'.Auth::user()->avatar }}" alt="User" width="100" height="100" class="img-rounded avatarUser"  />
    		</div>

        @if( Auth::check() && Auth::user()->status != 'pending' )
    		<div class="text-center">
    			<button type="button" class="btn btn-default btn-border btn-sm" id="avatar_file" style="margin-top: 10px;">
	    		<i class="icon-camera myicon-right"></i> {{ trans('misc.change_avatar') }}
	    		</button>
	    		<input type="file" name="photo" id="uploadAvatar" accept="image/*" style="visibility: hidden;">
    		</div>
      @endif

			</form><!-- *********** AVATAR ************* -->



		<!-- ***** FORM ***** -->
       <form action="{{ url('account') }}" method="post" name="form">

          	<input type="hidden" name="_token" value="{{ csrf_token() }}">

            <!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label class="font-default">{{ trans('misc.full_name_misc') }}</label>
              <input type="text" class="form-control login-field custom-rounded" value="{{ e( $user->name ) }}" name="full_name" placeholder="{{ trans('misc.full_name_misc') }}" title="{{ trans('misc.full_name_misc') }}" autocomplete="off">
             </div><!-- ***** Form Group ***** -->

			<!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label class="font-default">{{ trans('auth.email') }}</label>
              <input type="email" class="form-control login-field custom-rounded" value="{{$user->email}}" name="email" placeholder="{{ trans('auth.email') }}" title="{{ trans('auth.email') }}" autocomplete="off">
         </div><!-- ***** Form Group ***** -->

         <!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label class="font-default">{{ trans('misc.country') }}</label>
            	<select name="countries_id" class="form-control" >
                      		<option value="">{{trans('misc.select_your_country')}}</option>
                      	@foreach(  App\Models\Countries::orderBy('country_name')->get() as $country )
                            <option @if( $user->countries_id == $country->id ) selected="selected" @endif value="{{$country->id}}">{{ $country->country_name }}</option>
						@endforeach
                          </select>
            	    </div><!-- ***** Form Group ***** -->

           <button type="submit" id="buttonSubmit" class="btn btn-block btn-lg btn-main custom-rounded">{{ trans('misc.save_changes') }}</button>

       </form><!-- ***** END FORM ***** -->

		</div><!-- /COL MD -->

		<div class="col-md-4">
			@include('users.navbar-edit')
		</div>


 </div><!-- container -->

 <!-- container wrap-ui -->
@endsection

@section('javascript')

<script type="text/javascript">

	//<<<<<<<=================== * UPLOAD AVATAR  * ===============>>>>>>>//
    $(document).on('change', '#uploadAvatar', function(){

    $('.wrap-loader').show();

   (function(){
	 $("#formAvatar").ajaxForm({
	 dataType : 'json',
	 success:  function(e){
	 if( e ){
        if( e.success == false ){
		$('.wrap-loader').hide();

		var error = '';
                        for($key in e.errors){
                        	error += '' + e.errors[$key] + '';
                        }
		swal({
    			title: "{{ trans('misc.error_oops') }}",
    			text: ""+ error +"",
    			type: "error",
    			confirmButtonText: "{{ trans('users.ok') }}"
    			});

			$('#uploadAvatar').val('');

		} else {

			$('#uploadAvatar').val('');
			$('.avatarUser').attr('src',e.avatar);
			$('.wrap-loader').hide();
		}

		}//<-- e
			else {
				$('.wrap-loader').hide();
				swal({
    			title: "{{ trans('misc.error_oops') }}",
    			text: '{{trans("misc.error")}}',
    			type: "error",
    			confirmButtonText: "{{ trans('users.ok') }}"
    			});

				$('#uploadAvatar').val('');
			}
		   }//<----- SUCCESS
		}).submit();
    })(); //<--- FUNCTION %
});//<<<<<<<--- * ON * --->>>>>>>>>>>
//<<<<<<<=================== * UPLOAD AVATAR  * ===============>>>>>>>//
</script>
@endsection
