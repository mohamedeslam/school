@extends('layout.dashport-layout.master')
@section('titel',$titelPage)
@section('sidebar')
  <div class="col-lg-3">
    @parent
    @section('sidebar-item')
    @endsection
  </div>
@endsection
@section('content')
<div class="col-lg-9 vstack h-100 gap-2">

  <div aria-live="polite" aria-atomic="true" class="position-relative d-flex justify-content-center align-items-center w-100">
    <div class="toast-container top-0 p-3" style="z-index:11">

      <div class="toast @if(session()->has('success')) show @endif mb-2" role="alert" aria-live="assertive" aria-atomic="true" >
        <div class="toast-header">
          <i class="bg-success rounded p-1 text-white ms-2  fa-solid fa-check"></i>
          <strong class="text-success">تم</strong>
          <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          {{session()->get('success')}}
        </div>
      </div>

      <div class="toast mb-2 @if(session()->has('danger')) show @endif" role="alert" aria-live="assertive" aria-atomic="true" >
        <div class="toast-header">
          <i class="bg-danger rounded text-white p-1 ms-2 fa-solid fa-triangle-exclamation"></i>
          <strong class="text-danger">خطأ</strong>
          <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          {{session()->get('danger')}}
        </div>
      </div>
    </div>
  </div>
  <div class="card wrapper">
    <div class="card-header border-0 pb-0">
      <h4 class="h4 mb-0">المدارس النشطة</h4>
    </div>
    <div class="card-body">
      @if(count($getSchool) > 0)
        @foreach ($getSchool as $school)
          <div class="list-group mb-1 w-auto">
            <a href="{{route('school.show',['school' => $school->id ])}}" class="list-group-item list-group-item-action d-flex gap-3 p-2" aria-current="true">
              @if ($school->schoolLogo !=null)
                <div class="avatar avatar-md flex-shrink-0" width="32" height="32">
                  <img class="avatar-img rounded flex-shrink-0" src="{{asset('storage/'.$school->schoolLogo)}}" alt="avatar">
                </div>
              @else
                <?php
                  $num=rand(0,2);
                  if ($num == 0)
                  $color="danger";
                  elseif($num == 1)
                    $color="primary";
                  else
                    $color="warning";
                ?>
                <div class="avatar avatar-md flex-shrink-0" width="32" height="32">
                  <div class="avatar-img rounded bg-{{$color}} bg-opacity-25">
                    <span class="text-{{$color}} position-absolute top-50 start-50 translate-middle fw-bold">
                      {{ mb_substr($school->school_name, 0, 1) }}
                    </span>
                  </div>
                </div> 
              @endif
              <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                  <h6 class="mb-0">{{$school->school_name}}</h6>
                  @if(date('Y-m-d') >= $school->subscription)
                  <span class="d-block text-danger">خاملة</span>
                  @else
                  <span class="d-block text-success">نشطة</span>
                  @endif
                </div>
                <small>تاريخ انتهاء الاشتراك {{$school->subscription}}</small>
                </div>
              </a>
          </div>
        @endforeach
      @else
        <div class="h5 d-flex justify-content-center m-4">لم يتم إضافة اي مدرسة بعد</div>        
      @endif
    </div>
  </div>
</div>
@endsection