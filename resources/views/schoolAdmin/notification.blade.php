@extends('layout.schoolAdminLeyout.master')
@section('titel',$titelPage)
@section('sidebarSchoolAdmin')
  <div class="col-lg-3"></div>
@endsection
@section('showHideOffcanvasNavbar','d-none')
@section('content')
<?PHP
  use Illuminate\Support\Facades\Auth;
  use App\Models\user;
  use App\Models\school;
  use App\Models\teatcher;
  use App\Models\notification;
  $getID = json_decode($notification->data)->id;
  $getTitle = json_decode($notification->data)->title;
  $getMessage = json_decode($notification->data)->massege;
  // admin => 0 schoolAdmin => 1 teatcher =>2 student => 3
  $getUser  = user::findOrFail($getID);
  if($getUser->role == 'admin'){
    $activeClass  = false;
    $userName = $getUser->name;
  }elseif($getUser->role == 'schoolAdmin'){
    $userName = school::where('user_id',$getID)->get();
    $profileImage = $userName->value('logo');
    $profileName = $userName->value('school_name');
    $activeClass  = true;
  }elseif($getUser->role == 'teatcher'){
    $userName = teatcher::where('user_id',$getID)->get();
    $profileImage = $userName->value('teatcherProfile');
    $profileName = $userName->value('firstName');
    $activeClass  = true;
  } // [tudent] Continue Fondition For all Users Here
?>
<div class="col-lg-5">
  <div class="card">
    <div class="card-header border-0 pb-0">
      <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
          @if($activeClass == true)
          <div class="avatar text-center d-none d-sm-inline-block">
            <img class="avatar-img rounded-circle" src="{{asset('storage/'.$profileImage)}}" alt="">
          </div>
          @else
          <div class="avatar text-center d-none d-sm-inline-block">
            <div class="avatar-img rounded-circle bg-success"><span class="text-white position-absolute top-50 start-50 translate-middle fw-bold">{{ mb_substr($userName, 0, 1) }}</span></div>
          </div>
          @endif
          <div class="me-1">
            <h6 class="card-title mb-0">{{$userName}}</h6>
            <p class="mb-0 small">{{$notification->created_at}}</p>
          </div>
        </div>
        <a href="{{url('school/admin/notifications')}}" class="btn-close py-1 px-2">
        </a>
      </div>
    </div>
    <div class="card-body pb-1">
      <b>{{$getTitle}}</b>
      <p>{{$getMessage}}</p>
    </div>
  </div>
</div>
@endsection