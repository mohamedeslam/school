<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="{{asset('assets/logo.svg')}}" style="color: #0953d3;">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/icon/fontawesome-free-6.2.0-web/css/all.min.css')}}">
  <!-- Custom styles for this template-->
  {{-- <link rel="stylesheet" href=" {{asset('assets/css/main-dashport.css')}}"> --}}
  <link rel="stylesheet" href=" {{asset('assets/plugins/bootstrap/css/bootstrap.min.css') }} ">
  <link rel="stylesheet" href=" {{ asset('assets/css/sing-in.css') }} ">
  <link rel="stylesheet" href=" {{asset('assets/css/styleShowProfile.css')}}">
  {{-- <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}"> --}}
  <link rel="stylesheet" href=" {{asset('assets/css/minStyle.css') }} ">

  <title> @yield('titel', 'لايوجد عنوان') </title>
</head>

<body>
  <header class="navbar-light fixed-top header-static">
    @include('layout.schoolAdminLeyout.topbar')
  </header>

  {{-- Start Page Wrapper --}}
  <main>
    <div class="container">
      <div class="row">
        {{-- Start Sidebar --}}
          @include('layout.schoolAdminLeyout.sidebarSchoolAdmin')
        {{-- End Sidebar --}}

        {{-- Start Content Page --}}
        <div class="d-flex  mb-4 @yield('showHideOffcanvasNavbar','d-lg-none')">
          <button class="btn btn-primary fw-bold border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <i class="fa-solid fa-bars"></i>
          </button>
        </div>
          @yield('content')
        {{-- End Content Page --}}
      </div>
    </div>
  </main>

  <div class="modal fade" tabindex="-1" role="dialog" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content rounded-3 shadow">
        <div class="modal-body text-center p-4">
          <h5 class="mb-0 pb-3">جاهذ للمغادرة ؟</h5>
          <p class="mb-0">سيتم إنهاء جميع العمليات.</p>
        </div>
        <div class="modal-footer flex-nowrap p-0">
          <a href="{{route('logoutUsers')}}" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-start text-danger"><strong>تسجيل خروج</strong></a>
          <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal">إلغاء</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Start Modal Arria --}}
  @yield('modal')
  {{-- Start modal logout  --}}

  {{-- End Modal Arria --}}
  <script src=" {{ asset('assets/plugins/jquery/jquery.min.js') }} "></script>
  <script src=" {{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
  <script src=" {{ asset('assets/js/main-dashport.min.js') }} "></script>
  <script src=" {{ asset('assets/js/form-validation.js') }} "></script>
  {{-- <script src=" {{ asset('assets/js/functions.js') }} "></script> --}}
  <script src=" {{ asset('assets/js/password.js') }} "></script>
</body>
</html>