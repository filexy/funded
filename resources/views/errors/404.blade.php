
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>{{{ trans('error.error_404') }}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link href="{{ asset('public/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset('public/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
     <!-- Theme style -->
    <link href="{{ asset('public/admin/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset('public/admin/css/skins/_all-skins.min.css')}}" rel="stylesheet" type="text/css" />
    
    <link rel="shortcut icon" href="{{{ URL::asset('public/img/favicon.png') }}}" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="margin: 0;">

        <!-- Main content -->
        <section class="content">
          <div class="error-page text-center">
            <h2 class="headline text-red btn-block class-montserrat"> 404</h2>
            <div class="btn-block">
              <h3><i class="fa fa-warning text-red"></i> {{{ trans('error.error_404_description') }}}</h3>
              <p class="btn-block">
                {{{ trans('error.error_404_subdescription') }}} 
                
                <p class="btn-block">
                	 <a href="{{ URL::to('/') }}">{{{ trans('error.go_home') }}}</a>
                </p>
               
              </p>
         
            </div><!-- /.error-content -->
          </div><!-- /.error-page -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('public/plugins/jQuery/jQuery-2.1.4.min.js')}}" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('public/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{ asset('public/plugins/fastclick/fastclick.min.js')}}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/admin/js/app.min.js')}}" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('public/admin/js/demo.js')}}" type="text/javascript"></script>
  </body>
</html>
