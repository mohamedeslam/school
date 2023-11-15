<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href=" {{asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href=" {{ asset('assets/css/sing-in.css') }}">
  <title>تسجيل الدخول</title>
</head>

<body>
  <main>
    <div class="container">
      <div class="row justify-content-center align-items-center vh-100 py-5">
        <div class="col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
          <div class="card card-body text-center p-4 p-sm-5">
            <h1 class="mb-4">مرحباً بعودتك</h1>
            <p class="mb-0">انشاء حساب للطالب <a href="#">إضغط هنا لإنشاء الحساب</a></p>
            <form class="mt-sm-4" action="{{url('/login/checkLogin')}}" method="POST">
              @csrf
              {{-- @method('HEAD') --}}
              <div class="mb-3 input-group-lg">
                <input type="text" name="userName" class="form-control
                @error('userName') is-invalid @enderror" placeholder="اسم المستخدم">
                <div class="text-end small text-danger">
                  @if($message=Session::get('singInError'))
                  {{$message}}
                  @endif
                </div>
                @error('userName')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>

              <div class="mb-3 position-relative">
                <!-- Password -->
                <div class="input-group input-group-lg">
                  <input type="password" name="password" class="form-control fakepassword
                  @error('password') is-invalid @enderror" id="psw-input" placeholder="كلمة المرور">
                  @error('password')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="mb-3 d-sm-flex justify-content-between">
                <div>
                  <input class="form-check-input" id="check-me" type="checkbox">
                  <label class="form-check-label" for="check-me">زكرني؟</label>
                </div>
                <a href="#">نسيت كلمة المرور</a>
              </div>
              <div class="d-grid">
                <input class="btn btn-lg btn-primary" type="submit" value="تسجيل دخول">
              </div>
              <p class="mb-0 mt-3">كل الحقوق محفوظة <a target="_blank" href="https://www.webestica.com/"> #CODE
                  2022©</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>