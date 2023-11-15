@section('sidebarSchoolAdmin')
  <nav class="navbar navbar-light navbar-expand-lg mx-0 pt-0">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
      <!-- Offcanvas header -->
      <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <!-- Offcanvas body -->
      <div class="offcanvas-body p-0">
        <!-- Card START -->
        <div class="card w-100 border-0">
          <!-- Card body START -->
          <div class="card-body">
          <!-- Side Nav START -->
          <ul class="nav flex-column fw-bold gap-2 pe-0 border-0">
            <li class="nav-item" data-bs-dismiss="offcanvas">
              <a class="nav-link d-flex mb-0 active" href="{{route('school.admin')}}">
                <i class="fa-solid fa-house ms-2"></i>
                <span>الصفحة الرئيسية</span>
              </a>
            </li>

            <li class="nav-item" data-bs-dismiss="offcanvas">
              <a href="{{route('subject.index')}}" class="nav-link d-flex mb-0" data-bs-toggle="">
                <div>
                  <i class="fa-solid fa-book ms-2"></i>
                  <span>المواد الدراسية</span>
                </div>
              </a>
            </li>

              <li class="nav-item">
                <a class="nav-link d-flex justify-content-between mb-0 pb-0 collapsed" data-bs-toggle="collapse" href="#collapseSchool" aria-expanded="false" aria-controls="collapseSchool">
                  <div>
                    <i class="fa-solid fa-chalkboard-user ms-2"></i>
                    <span class="">المعلمين</span>
                  </div>
            
                </a>
                <div class="collapse" id="collapseSchool">
                  <div class="card card-body border-0 pt-0">
                    <a href="{{route('teatcher.index')}}" class="nav-link">عرض المعلمين</a>
                    <a href="{{route('teatcher.create')}}" class="nav-link">اضافة معلم جديد</a>
                  </div>
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link d-flex justify-content-between mb-0 pb-0 collapsed" data-bs-toggle="collapse" href="#collapsSubject" aria-expanded="false" aria-controls="collapsSubject">
                  <div>
                    <i class="fa-solid fa-users ms-2"></i>
                    <span class="">الطلاب</span>
                  </div>
                </a>
                <div class="collapse" id="collapsSubject">
                  <div class="card card-body border-0 pt-0">
                    <a href="#" class="nav-link pb-1">عرض الطلاب</a>
                    <a href="#" class="nav-link pb-1">اضافة طالب جديد</a>
                  </div>
                </div>
              </li>
            @yield('sidebar-item')
          </ul>
          <!-- Side Nav END -->
        </div>
        <!-- Card body END -->
        </div>
      <!-- Card END -->
      </div>
      <!-- Offcanvas body -->
      <!-- Copyright -->
      <p class="small text-center mt-1">©2022 <a class="text-body" target="_blank" href="https://www.webestica.com/"> #code كل الحقوق محفوظة  </a></p>
    
    </div>
  </nav>
@show