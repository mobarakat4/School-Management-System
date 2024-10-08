<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>@yield('title')</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<!-- core:css -->
	<link rel="stylesheet" href="{{asset('assets/vendors/core/core.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/mystyle/kotta.css')}}">
	<!-- endinject -->
    <link rel="stylesheet" href="{{asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css')}}">

	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="{{asset('assets/vendors/flatpickr/flatpickr.min.css')}}">
	<!-- End plugin css for this page -->
    <script
    src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous">
    </script>
    @yield('head')
	<!-- inject:css -->
	<link rel="stylesheet" href="{{asset('assets/fonts/feather-font/css/iconfont.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
	<!-- endinject -->

  <!-- Layout styles -->
    @if(session()->has('light'))

        @if(session()->get('locale' ) == 'en' )
            <link rel="stylesheet" href="{{asset('assets/css/demo1/style.css')}}">
        @else
            <link rel="stylesheet" href="{{asset('assets/css/demo1/style-rtl.css')}}">
            <link rel="stylesheet" href="{{asset('assets/css/mystyle/kotta-rtl.css')}}">
        @endif


    @else


        @if(session()->get('locale' ) == 'en' )
            <link rel="stylesheet" href="{{asset('assets/css/demo2/style.css')}}">

        @else
            <link rel="stylesheet" href="{{asset('assets/css/demo2/style-rtl.css')}}">
            <link rel="stylesheet" href="{{asset('assets/css/mystyle/kotta-rtl.css')}}">
        @endif
    @endif
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" />
  {{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('de85d7ba66b720f51c6f', {
      cluster: 'eu'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(np));
    });
  </script> --}}
          @vite([ 'resources/js/firebase.js'])

</head>
