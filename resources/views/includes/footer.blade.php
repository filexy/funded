<!-- ***** Footer ***** -->
    <footer class="footer-main">
    	<div class="container">

    		<div class="row">
    			<div class="col-md-4">
    				<a href="{{ url('/') }}">
    					<img src="{{ asset('public/img/watermark.png') }}" />
    				</a>
    			   <p class="margin-tp-xs">{{ $settings->description }}</p>

    			   <ul class="list-inline">
					   @if( $settings->twitter != '' )
					   <li><a href="{{$settings->twitter}}" class="ico-social"><i class="fa fa-twitter"></i></a></li>
					   @endif

					 @if( $settings->facebook != '' )
					   <li><a href="{{$settings->facebook}}" class="ico-social"><i class="fa fa-facebook"></i></a></li>
					 @endif

					 @if( $settings->instagram != '' )
					   <li><a href="{{$settings->instagram}}" class="ico-social"><i class="fa fa-instagram"></i></a></li>
					 @endif

					 @if( $settings->linkedin != '' )
					   <li><a href="{{$settings->linkedin}}" class="ico-social"><i class="fa fa-linkedin"></i></a></li>
					   @endif
					 </ul>

    			</div><!-- ./End col-md-* -->



    			<div class="col-md-3 margin-tp-xs">
    				<h4 class="margin-top-zero">{{trans('misc.about')}}</h4>
    				<ul class="list-unstyled">
    					@foreach( App\Models\Pages::all() as $page )
        			<li><a class="link-footer" href="{{ url('/page',$page->slug) }}">{{ $page->title }}</a></li>
        	@endforeach
    				</ul>
    			</div><!-- ./End col-md-* -->


    			<div class="col-md-3 margin-tp-xs">
    				<h4 class="margin-top-zero">{{trans('misc.categories')}}</h4>
    				<ul class="list-unstyled">
    					@foreach(  App\Models\Categories::where('mode','on')->orderBy('name')->take(6)->get() as $category )
        			<li><a class="link-footer" href="{{ url('category') }}/{{ $category->slug }}">{{ $category->name }}</a></li>
        	@endforeach

        	@if( App\Models\Categories::count() > 6 )
        		<li><a class="link-footer" href="{{ url('categories') }}">
        			<strong>{{ trans('misc.view_all') }} <i class="fa fa-long-arrow-right"></i></strong>
        		</a></li>
        		@endif

    				</ul>
    			</div><!-- ./End col-md-* -->

    			<div class="col-md-2 margin-tp-xs">
    				<h4 class="margin-top-zero">{{trans('misc.links')}}</h4>
    				<ul class="list-unstyled">

        			<li>
        				<a class="link-footer" href="{{ url('/') }}">{{ trans('misc.campaigns') }}</a>
        			</li>

        			@if( Auth::guest() )
        			<li>
        				<a class="link-footer" href="{{ url('login') }}">
        					{{ trans('auth.login') }}
        				</a>
        				</li>


        				@else
        				<li>
	          		 		<a href="{{ url('account') }}" class="link-footer">
	          		 			{{ trans('users.account_settings') }}
	          		 		</a>
	          		 		</li>

	          		 		<li>
	          		 			<a href="{{ url('logout') }}" class="logout link-footer">
	          		 				{{ trans('users.logout') }}
	          		 			</a>
	          		 		</li>
        				@endif

    				</ul>
    			</div><!-- ./End col-md-* -->
    		</div><!-- ./End Row -->
    	</div><!-- ./End Container -->
    </footer><!-- ***** Footer ***** -->

<footer class="subfooter">
	<div class="container">
	<div class="row">
    			<div class="col-md-12 text-center padding-top-20">
    				<p>&copy; Funded - <?php echo date('Y'); ?> Developed By <a href="https://felixitsolutions.com">Contilight Creative </a></p>
    			</div><!-- ./End col-md-* -->
	</div>
</div>
</footer>
