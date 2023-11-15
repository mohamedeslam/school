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
  <div class="card wrapper">
    <div class="card-header border-0 pb-0">
      <h4 class="h4 mb-0">المدارس الخاملة</h4>
    </div>
    <div class="card-body">
      @if(count($getExpiratSchool) > 0)
        @foreach ($getExpiratSchool as $school)
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
                  <span class="d-block text-danger mt-2">اضغط هنا لتجديد الاشتراك</span>
                </div>
                <small>تاريخ انتهاء الاشتراك {{$school->subscription}}</small>
              </div>
            </a>
          </div>
        @endforeach
      @else
        <div class="h5 d-flex justify-content-center m-4">لاتوجد اي مدرسة خاملة</div>        
      @endif
    </div>
  </div>
</div>
@endsection


