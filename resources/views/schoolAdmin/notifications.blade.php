@extends('layout.schoolAdminLeyout.master')
@section('titel',$titelPage)
@section('sidebarSchoolAdmin')
  <div class="col-lg-3">
    @parent
    @section('sidebar-item')    
    @endsection
  </div>
@endsection
@section('content')
<div class="col-lg-8">
  <div class="card w-75-sm">
    <div class="card-header py-3 border-0 d-flex align-items-center justify-content-between">
      <h1 class="h5 mb-0">الإشعارات</h1>
      <!-- Notification action START -->
      <div class="dropdown">
        <a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2" id="cardNotiAction" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa-solid fa-ellipsis-vertical p-1"></i>
        </a>
        <!-- Card share action dropdown menu -->
        <ul class="dropdown-menu dropdown-menu-end text-end" aria-labelledby="cardNotiAction">
          <li><a class="dropdown-item" href="/school/admin/notifications/markAsRead"> <i class="fa-solid fa-ellipsis-vertical p-2"></i></i>تعين قراء الكل</a></li>
          <li><a class="dropdown-item" href="/school/admin/notifications/delete"> <i class="fa-solid fa-ellipsis-vertical p-2"></i></i>حذف الكل </a></li>
        </ul>
      </div>
      <!-- Notification action END -->
    </div>
        <?php                  
          use Illuminate\Support\Facades\Auth;
          use App\Models\user;
          use App\Models\school;
          use App\Models\teatcher;
          use App\Models\notification;        
        ?>
    <div class="card-body p-2">
      <?php $youHaveNotification = false; ?>
      @foreach(auth()->user()->notifications as $countNotification)
        @if($countNotification->count()> 0)
          <?php $youHaveNotification = true; ?>
        @endif
      @endforeach
      @if($youHaveNotification == true)
      <ul class="list-unstyled pe-0">
        @foreach(auth()->user()->notifications as $notification)
        <?PHP
          // admin => 0 schoolAdmin => 1 teatcher =>2 student => 3
          $getUser  = user::findOrFail($notification->data['id']);
          if($getUser->role == 'admin'){
            $activeClass  = false;
            $profileName = $getUser->name;
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
          ?>
        <li>
          <a href="/school/admin/notification/{{$notification->id}}" class="rounded d-sm-flex border-0 mb-1 p-3 position-relative list-group-item @if( $notification->read_at == null ) badge-unread  @endif">
            @if($activeClass == true)
            <div class="avatar text-center d-none d-sm-inline-block">
              <img class="avatar-img rounded-circle" src="{{asset('storage/'.$profileImage)}}" alt="">
            </div>
            @else
            <div class="avatar text-center d-none d-sm-inline-block">
              <div class="avatar-img rounded-circle bg-success"><span class="text-white position-absolute top-50 start-50 translate-middle fw-bold">{{ mb_substr($profileName, 0, 1) }}</span></div>
            </div>
            @endif
            <div class="me-1 flex-grow-1 d-block">
              <h6 class="mb-2 mt-1">{{$profileName}}</h6>
              <b class="me-1">{{$notification->data['title']}}</b>
              <div class="small text-secondary mb-2 me-1">{{$notification->data['massege']}}</div>
            </div>
            <!-- Action -->
            <div class="d-flex ms-auto">
              <p class="small  text-nowrap">8min</p><br>
            </div>
          </a>
        </li>
      @endforeach
      </ul>
      @else
      <div class="h5 d-flex justify-content-center m-4">لا توجد إشعارات</div>        
      @endif
    </div>
    <div class="card-footer border-0 py-3 text-center position-relative d-grid pt-0">
      <!-- Load more button START -->
      <a href="{{url("school/admin/notifications")}}" role="button" class="btn btn-loader btn-primary-soft" data-bs-toggle="button" aria-pressed="true">
        <span class="load-text"> جلب المذيد من الاشعارات</span>
        <div class="load-icon">
          <div class="spinner-grow spinner-grow-sm" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      </a>
      <!-- Load more button END -->
    </div>
  </div>
</div>
@endsection