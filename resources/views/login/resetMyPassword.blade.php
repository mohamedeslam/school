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
  <title>إعادة تعين كلمة المرور</title>
  <script>
		const storedTheme = localStorage.getItem('theme')
		const getPreferredTheme = () => {
			if (storedTheme) {
				return storedTheme
			}
			return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'light'
		}

		const setTheme = function (theme) {
			if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
				document.documentElement.setAttribute('data-bs-theme', 'dark')
			} else {
				document.documentElement.setAttribute('data-bs-theme', theme)
			}
		}

		setTheme(getPreferredTheme())

		window.addEventListener('DOMContentLoaded', () => {
		    var el = document.querySelector('.theme-icon-active');
			if(el != 'undefined' && el != null) {
				const showActiveTheme = theme => {
				const activeThemeIcon = document.querySelector('.theme-icon-active use')
				const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
				const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

				document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
					element.classList.remove('active')
				})

				btnToActive.classList.add('active')
				activeThemeIcon.setAttribute('href', svgOfActiveBtn)
			}

			window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
				if (storedTheme !== 'light' || storedTheme !== 'dark') {
					setTheme(getPreferredTheme())
				}
			})

			showActiveTheme(getPreferredTheme())

			document.querySelectorAll('[data-bs-theme-value]')
				.forEach(toggle => {
					toggle.addEventListener('click', () => {
						const theme = toggle.getAttribute('data-bs-theme-value')
						localStorage.setItem('theme', theme)
						setTheme(theme)
						showActiveTheme(theme)
					})
				})

			}
		})
	</script>
  </head>
  <body>
    <style>
      #pswmeter {
        height: 8px;
        background-color: #eee;
        position: relative;
        overflow: hidden;
        border-radius: 4px;
      }
      #pswmeter .password-strength-meter-score {
        height: inherit;
        width: 0%;
        transition: .3s ease-in-out;
        background: #dc3545;
      }
      #pswmeter .password-strength-meter-score.psms-25 {width: 25%; background: #dc3545;}
      #pswmeter .password-strength-meter-score.psms-50 {width: 50%; background: #f7c32e;}
      #pswmeter .password-strength-meter-score.psms-75 {width: 75%; background: #4f9ef8;}
      #pswmeter .password-strength-meter-score.psms-100 {width: 100%; background: #0cbc87;}
    </style>
    <main>
      <!-- Container START -->
      <div class="container">
        <div class="row justify-content-center align-items-center vh-100 py-5">
          <!-- Main content START -->
          <div class="col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
            <!-- Forgot password START -->
            <div class="card card-body rounded-3 text-center p-4 p-sm-5">
              <!-- Title -->
              <h1 class="mb-2">إعادة تعين كلمة المرور</h1>
              <p>الرجاء إختيار كلمة كلمة مرور قوية</p>
              <!-- form START -->
              <form class="mt-3">
                <!-- New password -->
                <div class="mb-3">
                  <!-- Input group -->
                  <div class="input-group input-group-lg mb-2">
                    <span class="input-group-text p-0">
                      <i class="fakepasswordicon fa-solid fa-eye-slash cursor-pointer p-2 w-40px"></i>
                    </span>
                    <input class="form-control fakepassword" type="password" id="psw-input" placeholder="ادخل كلمة المرور">
                  </div>
                  <div class="input-group input-group-lg">
                    <input class="form-control fakepassword2" type="password" id="psw-input2" placeholder="تأكيد كلمة المرور">
                  </div>
                  <!-- Pswmeter -->
                  <div id="pswmeter" class="mt-2"></div>
                  <div class="d-flex mt-1">
                    <div id="pswmeter-message" class="rounded"></div>
                    <!-- Password message notification -->
                    <div class="me-auto">

                      <div class="me-auto">
                        <span class="d-inline-block" tabindex="0" data-bs-placement="top" data-bs-container="body" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="للوصول إلى كلمة مرور ممتازة الرجاء إتباع التالي , حرف واحد كبير, حرف واحد صغير, رقم واحد على الأقل و ان تتكون من 8 خانات .">
                          <i class="fa-solid fa-circle-info cursor-pointer pe-1"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Back to sign in -->
                <div class="mb-3">
                  <p>الرجوع إلى <a href="sign-in.html">تسجيل الدخول</a></p>
                </div>
                <!-- Button -->
                <div class="d-grid"><button type="submit" class="btn btn-lg btn-primary">إعادة تعين كلمة المرور</button></div>
                <!-- Copyright -->
                <p class="mb-0 mt-3">©2023 <a target="_blank" href="https://www.webestica.com/">Hashcode</a> All rights reserved</p>
              </form>
              <!-- form END -->
            </div>
            <!-- Forgot password END -->
          </div>
        </div> <!-- Row END -->
      </div>
    
      <!-- Container END -->

    </main>
    <div class="betternet-wrapper"></div>
  </body>
  <script src=" {{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
  <script src=" {{ asset('assets/js/pswmeter.min.js') }} "></script>
  <script src=" {{ asset('assets/js/functions.js') }} "></script>
</html>