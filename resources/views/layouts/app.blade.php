<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('template/assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('template/assets/css/styles.min.css') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">



</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
   @yield('sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
    @yield('header')
      <!--  Header End -->
     @yield('content')


     @include('layouts.footer')

    </div>
  </div>


  @include('layouts.script')
</body>

</html>
