<nav class="navbar navbar-expand navbar-light bg-white" aria-label="Second navbar example">
    <div class="container">
      <div class="dropdown">
        <div class="avatar avatar-md flex-shrink-0 nav-link btn icon-md p-0" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="avatar-img rounded bg-primary bg-opacity-25">
            <span class="text-primary position-absolute top-50 start-50 translate-middle fw-bold">
              7A
            </span>
          </div>
        </div>
        <ul class="dropdown-menu dropdown-animation dropdown-menu-end text-end pt-3 small me-md-n3 rounded-3" aria-labelledby="profileDropdown">
          <li>
            <a class="dropdown-item bg-danger-soft-hover" href="#"><i class="fa-regular fa-user ms-2"></i>الملف الشخصي</a>
          </li>
          <li>
            <a class="dropdown-item bg-danger-soft-hover" href="#"><i class="fa-solid fa-gear ms-2"></i>الاعدادات العامة</a>
          </li>
          <li class="dropdown-divider"></li>
          <li>
            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fa-solid fa-arrow-right-from-bracket ms-2"></i>تسجيل خروج</button>
          </li>
        </ul>
      </div>
      <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">

            <div class="dropdown dropdown-message">
              <a class="nav-link icon-md btn btn-light p-0 " href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="badge-notif animation-blink"></span>
                <i class="fa-solid fa-bell text-secondary"></i>
              </a>
              <ul class="dropdown-menu dropdown-animation dropdown-menu-start text-end pt-3 pb-0 me-md-n3 rounded-3 shadow overflow-hidden w-280px" aria-labelledby="profileDropdown">
                
                <h6 class="dropdown-header text-center text-primary">
                  الاشعارات
                </h6>

              <li>
                <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                    <div>
                      <div class="text-truncate">I have the photos that you ordered last month, how
                          would you like them sent to you?</div>
                      <div class="small text-secondary">Jae Chun · 1d</div>
                  </div>

                    <div class="dropdown-list-image">
                        <img class="avatar-img rounded-circle" src="{{asset('storage\logo_school_img\0OCep10FupxZzGNIwzng9krGdWwCe062pbSKKnsE.jpg')}}" alt="...">
                    </div>
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                    <div>
                      <div class="text-truncate">I have the photos that you ordered last month, how
                          would you like them sent to you?</div>
                      <div class="small text-secondary">Jae Chun · 1d</div>
                  </div>
                    <div class="dropdown-list-image">
                        <img class="avatar-img rounded-circle" src="{{asset('storage\logo_school_img\0OCep10FupxZzGNIwzng9krGdWwCe062pbSKKnsE.jpg')}}" alt="...">
                    </div>
                </a>
              </li>
              <a class="dropdown-item text-center small text-secondary" href="#">اعادة تعين جميع الاشعارات</a>
              </ul>
            </div>
        </ul>
      </div>
      <a class="navbar-brand" href="#"><i class="fas fa-fw fa-school text-primary fs-4"></i></a>
    </div>
  </nav>