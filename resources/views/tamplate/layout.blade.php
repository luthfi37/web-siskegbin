<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Siskegbin </title>

    {{-- css --}}
    @include('include.style')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><img src=" {{ asset('foto/Lambang.png') }} " width="50">&nbsp<span>TNI-AD</span></a>
            </div>



            <div class="clearfix"></div>

            <!-- menu profile quick info -->

            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @include('include.sidebar')

            <!-- /menu footer buttons -->

            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        @include('include.navbar')
        <!-- /top navigation -->
        <div class="right_col" role="main">
        <!-- page content -->
        @yield('content')
        </div>
          <!-- /top tiles -->




                <!-- Start to do list -->

                <!-- End to do list -->

                <!-- start of weather widget -->

                <!-- end of weather widget -->
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @include('include.footer')
        <!-- /footer content -->
      </div>
    </div>

    {{-- java script --}}
    @include('include.script')
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    @stack('DataTables')
    @stack('scripts')
  </body>
</html>
