<?php                  
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\school;
use App\Models\teatcher;
?>
<nav class="navbar navbar-expand navbar-light bg-white" aria-label="Second navbar example">
  <div class="container">
    <div class="dropdown">
      <div class="avatar avatar-md flex-shrink-0 nav-link btn icon-md p-0" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
      <?PHP
      $userID = auth()->user()->id;
      $getUser = user::find($userID);
      $num=rand(0,2);
      if ($num == 0)
      $color="danger";
      elseif($num == 1)
        $color="primary";
      else
        $color="warning";
      ?>
        @if ($getUser->schoolLogo !=null)
          <div class="avatar-img rounded">
            <img class="avatar-img rounded flex-shrink-0" src="{{asset('storage/'.$getUser->schoolLogo)}}" alt="avatar">
          </div>
        @else
        <div class="avatar-img rounded bg-{{$color}} bg-opacity-25">
          <span class="text-{{$color}} position-absolute top-50 start-50 translate-middle fw-bold">
            {{mb_substr($getUser->name, 0, 1)}}
          </span>
        </div>
        @endif
      </div>
      <ul class="dropdown-menu dropdown-animation dropdown-menu-end text-end pt-3 small me-md-n3 rounded-3" aria-labelledby="profileDropdown">
        <li>
          <a class="dropdown-item bg-danger-soft-hover" href="#"><i class="fa-regular fa-message ms-2"></i>ارسال إشعار للكل</a>
        </li>
        <li>
          <a class="dropdown-item bg-danger-soft-hover" href="{{url("school/admin/settings")}}"><i class="fa-solid fa-gear ms-2"></i>الاعدادات العامة</a>
        </li>
        <li class="dropdown-divider"></li>
        <li>
          <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fa-solid fa-arrow-right-from-bracket ms-2"></i>تسجيل خروج</button>
        </li>
      </ul>
    </div>
    <div class="collapse navbar-collapse" id="navbarsExample02">
      <ul class="navbar-nav me-auto">
        <div class="dropdown dropdown-message">          
          <a class="nav-link icon-md btn btn-light p-0 " href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside">
            @foreach(auth()->user()->unreadnotifications as $chickNotification)
              @if($chickNotification !== NULL)
                <span class="badge-notif animation-blink"></span>
              @endif
            @endforeach
            <i class="fa-solid fa-bell text-secondary"></i>
          </a>
          <div class="dropdown-menu dropdown-animation dropdown-menu-start dropdown-menu-size-md-sm p-0 shadow-lg border-0" aria-labelledby="profileDropdown">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
              <?php 
              $countNotification = auth()->user()->unreadnotifications;
              $countNoty = count($countNotification);
              ?>
              <h6 class="m-0">الاشعارات <span class="badge bg-danger bg-opacity-10 text-danger ms-2">جديد {{$countNoty}}</span></h6>
                <a class="small aCostum" href="/school/admin/notifications/markAsRead">تعين قراءة الكل</a>
              </div>
              <div class="card-body p-0">
                <?php $youHaveNotification = false; ?>
                @foreach(auth()->user()->unreadnotifications as $countNotification)
                @if($countNotification->count() > 0)
                  <?php $youHaveNotification = true; ?>
                @endif
                @endforeach
                @if($youHaveNotification == true)
                <ul class="list-group list-group-flush list-unstyled p-2">
                  @foreach(auth()->user()->unreadnotifications as $notification)
                  <?PHP
                    // admin => 0 schoolAdmin => 1 teatcher =>2 student => 3
                    // $activeClass = true;
                    $getUser  = user::findOrFail($notification->data['id']);
                    // dd($getUser->role);
                    if($getUser->role == 'admin'){
                      $activeClass  = false;
                      $profileName = 'Admin School';
                    }elseif($getUser->role == 'schoolAdmin'){
                      $profile = school::where('user_id',$notification->data['id'])->get();
                      $profileImage = $profile->value('logo');
                      $profileName = $profile->value('school_name');
                      $activeClass  = true;
                    }elseif($getUser->role == 'teatcher'){
                      $profile = teatcher::where('user_id',$notification->data['id'])->get();
                      $profileImage = $profile->value('teatcherProfile');
                      $profileName = $profile->value('firstName');
                      $activeClass  = true;
                    } // [tudent] Continue Fondition For all Users Here
                    
                    $num = rand(0, 2);
                    if ($num == 0)
                        $color = "secondary";
                    elseif ($num == 1)
                        $color = "info";
                    else
                        $color =  "dark";
                    ?>
                  <li>
                    <a href="/school/admin/notification/{{$notification->id}}" class=" text-end list-group-item list-group-item-action rounded d-flex border-0 p-3 mb-1 badge-unread justify-content-between">
                      <div class="d-flex">
                        @if($activeClass == true)
                        <div class="avatar text-center d-none d-sm-inline-block">
                          <img class="avatar-img rounded-circle" src="{{asset('storage/'.$profileImage)}}" alt="">
                        </div>
                        @else
                        <div class="avatar text-center d-none d-sm-inline-block">
                          <div class="avatar-img rounded-circle bg-success"><span class="text-white position-absolute top-50 start-50 translate-middle fw-bold">{{ mb_substr($profileName, 0, 1) }}</span></div>
                        </div>
                        @endif

                        <div class="me-sm-3 flex-grow-1 d-block">
                          <h6 class="mb-0 mt-1">{{$profileName}}</h6>
                          <div class="small text-secondary mb-2 text-truncatec">{{$notification->data['title']}}</div>
                        </div>
                      </div>
                      <div class="small me-3">
                        {{$notification->created_at->day}} يوم
                      </div>
                    </a>
                  </li>
                  @endforeach
                </ul>
                @else
                <div class="d-flex justify-content-center m-4">لا توجد إشعارات</div>        
                @endif
              </div>
              <div class="card-footer border-0 pb-2 pt-0 px-2 text-center position-relative">
                <a href="/school/admin/notifications" role="button" class="btn btn-sm w-100 btn-primary-soft ">
                  كل الإشعارات
                </a>
              </div>
            </div>     
          </div>
        </div>
      </ul>
    </div>
    <a class="navbar-brand" href="#"><i class="fas fa-fw fa-school text-primary fs-4"></i></a>
  </div>
</nav>
