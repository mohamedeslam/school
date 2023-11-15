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
    <div class="card-header d-flex justify-content-between border-0 pb-0">
      <h4 class="h4 mb-0">المعلمين</h4>
      <div class="btn ps-1"><i class="fa-solid fa-ellipsis text-dark fs-5"></i></div>
    </div>
    <div class="card-body">
      @if(count($getTeatcher) > 0)
        @foreach ($getTeatcher as $teatcher)
          <div class="list-group mb-1 w-auto">
            <a href="{{url('school/admin/teatcher',['teatcher' => $teatcher->id])}}" class="list-group-item list-group-item-action d-flex gap-3 p-2" aria-current="true">
              @if ($teatcher->teatcherProfile !=null)
                <div class="avatar avatar-md flex-shrink-0" width="32" height="32">
                  <img class="avatar-img rounded flex-shrink-0" src="{{asset('storage/'.$teatcher->teatcherProfile)}}" alt="avatar">
                </div>
              @else
                <div class="avatar avatar-md flex-shrink-0" width="32" height="32">
                  <div class="avatar-img rounded bg-{{$color}} bg-opacity-25">
                    <span class="text-{{$color}} position-absolute top-50 start-50 translate-middle fw-bold">
                      {{ mb_substr($teatcher->firstName, 0, 1) }}
                    </span>
                  </div>
                </div> 
              @endif
              <div>
                <h6 class>{{$teatcher->firstName.' '.$teatcher->lastName }}</h6>
                <div class="text-scondary">{{$teatcher->id}} |  {{$teatcher->email}}</div>
              </div>
              </a>
          </div>
        @endforeach
      @else
        <div class="h5 d-flex justify-content-center m-4">لم يتم إضافة اي معلم بعد</div>        
      @endif
    </div>
  </div>
</div>
@endsection