<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="Mikhail">
  <title>@yield('title','Admin Page')</title>
  <link rel="apple-touch-icon" href="{{ asset('admin-assets/images/ico/apple-icon-120.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin-assets/images/ico/favicon.ico') }}">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/vendors.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/weather-icons/climacons.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/fonts/meteocons/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/charts/morris.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/charts/chartist.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/charts/chartist-plugin-tooltip.css') }}">
  
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/tables/datatable/datatables.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/tables/extensions/responsive.dataTables.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/tables/extensions/colReorder.dataTables.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/tables/extensions/fixedHeader.dataTables.min.css') }}">
  
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/forms/toggle/bootstrap-switch.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/forms/toggle/switchery.min.css') }}">
  
  <!-- END VENDOR CSS-->


  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/app.css') }}">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/core/menu/menu-types/vertical-content-menu.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/core/colors/palette-gradient.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/fonts/simple-line-icons/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/core/colors/palette-gradient.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/pages/timeline.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/pages/dashboard-ecommerce.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/core/menu/menu-types/vertical-content-menu.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/core/colors/palette-gradient.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/plugins/animate/animate.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/plugins/extensions/toastr.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/plugins/forms/validation/form-validation.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/plugins/forms/switch.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/core/colors/palette-switch.css') }}">
  <!-- END Page Level CSS-->

  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/style.css') }}">
  @yield('style')
  <!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-content-menu 2-columns menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
  
  {{--include top-nav--}}
  @include('layouts.includes.admin.top-nav')

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>

      {{--include sidebar--}}
      @include('layouts.includes.admin.sidebar')

      <div class="content-body">
        <!-- content body -->
        
        @if (session()->has('success'))
          <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            {{ session()->get('success') }}
          </div>
        @endif
        
        @if (session()->has('error'))
          <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            {{ session()->get('error') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
            <span class="alert-icon"><i class="la la-info-circle"></i></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            Something was gone wrong
            <br />
            @foreach ($errors->all() as $key=>$error)
              {{ $key .'=>'. $error }} ,<br />  
            @endforeach
          </div>
        @endif

        @yield('content')
        <!--/content body -->
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->

  {{--include footer--}}
  @include('layouts.includes.admin.footer')
  <!-- BEGIN VENDOR JS-->
  <script src="{{ asset('admin-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  
  <script src="{{ asset('admin-assets/vendors/js/ui/headroom.min.js') }}" type="text/javascript"></script>
  
  <script src="{{ asset('admin-assets/vendors/js/charts/chartist.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/charts/chartist-plugin-tooltip.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/charts/raphael-min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/charts/morris.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/timeline/horizontal-timeline.js') }}" type="text/javascript"></script>

  <script src="{{ asset('admin-assets/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/tables/buttons.colVis.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/tables/datatable/dataTables.colReorder.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/tables/datatable/dataTables.fixedHeader.min.js') }}" type="text/javascript"></script>

  <script src="{{ asset('admin-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
  
  <script src="{{ asset('admin-assets/vendors/js/forms/extended/typeahead/typeahead.bundle.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/forms/extended/typeahead/bloodhound.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/forms/extended/typeahead/handlebars.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/forms/extended/formatter/formatter.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/forms/extended/maxlength/bootstrap-maxlength.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/forms/extended/card/jquery.card.js') }}" type="text/javascript"></script>
 
  <script src="{{ asset('admin-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>

  <script src="{{ asset('admin-assets/vendors/js/extensions/toastr.min.js') }}" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  
  
  <!-- BEGIN MODERN JS-->
  <script src="{{ asset('admin-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/js/core/app.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
  <!-- END MODERN JS-->

  <!-- BEGIN PAGE LEVEL JS-->
  <script src="{{ asset('admin-assets/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/js/scripts/modal/components-modal.js') }}" type="text/javascript"></script>


  <script src="{{ asset('admin-assets/js/scripts/forms/extended/form-typeahead.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/js/scripts/forms/extended/form-inputmask.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/js/scripts/forms/extended/form-formatter.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/js/scripts/forms/extended/form-maxlength.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/js/scripts/forms/extended/form-card.js') }}" type="text/javascript"></script>
  
  <script src="{{ asset('admin-assets/js/scripts/extensions/toastr.js') }}" type="text/javascript"></script>
  
  <script src="{{ asset('admin-assets/js/scripts/tables/datatables-extensions/datatable-responsive.js') }}" type="text/javascript"></script>

  
  <script src="{{ asset('admin-assets/js/scripts/forms/validation/form-validation.js') }}" type="text/javascript"></script>

  <script src="{{ asset('admin-assets/js/scripts/forms/switch.js') }}" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->

  

  @yield('script')
</body>
</html>