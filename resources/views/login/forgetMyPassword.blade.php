<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href=" {{ asset('assets/plugins/icon/fontawesome-free-6.2.0-web/css/all.min.css') }}">
  <link rel="stylesheet" href=" {{asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href=" {{ asset('assets/css/sing-in.css') }}">
  <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">

  <title>نسيت كلمة المرور</title>

</head>

<body>
  <main>
    <div class="container">
      <div class="row justify-content-center align-items-center vh-100 py-5">
        <div class="col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
          <div class="card card-body rounded-3 text-center p-4 p-sm-5">
            <!-- Title -->
            <h1 class="mb-2">إعادة تعين كلمة المرور</h1>
            <p>الرجاء ادخال البريد الإلكتروني المرتبط في الحساب</p>
            <form class="mt-3">
              <!-- New password -->
              <div class="mb-3">
                <div class="input-group input-group-lg">
                  <input class="form-control" type="text"
                    placeholder="ادخل البريد الإلكتروني ">
                </div>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-lg btn-primary">إعادة تعين كلمة المرور</button>
              </div>
              <div class="mt-3">
                <p>الرجوع إلى <a href="sign-in.html">تسجيل الدخول</a></p>
              </div>
              <p class="mb-0 mt-3">©2023 <a target="_blank" href="https://www.webestica.com/">Hashcode</a> All rights
                reserved</p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  <div class="betternet-wrapper"></div>
</body>
<script src=" {{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>

</html>