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
      <div class="toast mb-2 @error('subjectName') show @enderror" role="alert" aria-live="assertive" aria-atomic="true" >
        <div class="toast-header">
          <i class="bg-danger rounded text-white p-1 ms-2 fa-solid fa-triangle-exclamation"></i>
          <strong class="text-danger">خطأ</strong>
          <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          يوجد خطاء في اسم المادة الدراسية
        </div>
      </div>
      <div class="toast mb-2 @error('level') show @enderror" role="alert" aria-live="assertive" aria-atomic="true" >
        <div class="toast-header">
          <i class="bg-danger rounded text-white p-1 ms-2 fa-solid fa-triangle-exclamation"></i>
          <strong class="text-danger">خطأ</strong>
          <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          يوجد خطاء في المستوى التعليمي التعليمي
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="crad">
        <div class="card-body p-0">
          <div class="bd-example-snippet bd-code-snippet">
            <div class="bd-example">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="" aria-label="الشريحة الأولى"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="الشريحة الثانية" class="active" aria-current="true"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="الشريحة الثالثة" class=""></button>
              </div>
              <div class="carousel-inner rounded-3">
                <div class="carousel-item active carousel-item-start">
                  <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="227" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: الشريحة الأولى" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#fff"></rect><text x="50%" y="20%" fill="#0d6efd" dy=".3em">أهم الإحصائيات</text></svg>
    
                  <div class="carousel-caption text-dark">
                    <div class="card card-body  py-4 border-0 p-0 m-0 ">
                      <div class="d-flex justify-content-between align-items-center">
                          <!-- Digit -->
                          <div>
                              <div class="fs-2 fw-bold text-end">1235</div>
                              <span class="mb-0 h6">PDF</span>
                          </div>
                          <!-- Icon -->
                          <div class="icon-xl rounded-2 bg-primary text-white mb-0"><i class="fa-regular fa-file-pdf fs-5"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="carousel-item carousel-item-next carousel-item-start">
                  <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="227" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: الشريحة الثانية" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#fff"></rect><text x="50%" y="20%" fill="#ffc107" dy=".3em">إهم الإحصائيات</text></svg>
                  <div class="carousel-caption text-dark">
                    <div class="card card-body  py-4 border-0 p-0 m-0 ">
                      <div class="d-flex justify-content-between align-items-center">
                          <!-- Digit -->
                          <div>
                              <div class="fs-2 fw-bold text-end">1235</div>
                              <span class="mb-0 h6">فيديو</span>
                          </div>
                          <!-- Icon -->
                          <div class="icon-xl rounded-2 bg-warning text-white mb-0"><i class="fa-solid fa-video fs-5"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="227" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: الشريحة الثالثة" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#fff"></rect><text x="50%" y="20%" fill="#6c757d" dy=".3em">إهم الإحصائيات</text></svg>
                  {{-- d-none d-md-block --}}
                  <div class="carousel-caption text-dark">
                    <div class="card card-body  py-4 border-0 p-0 m-0 ">
                      <div class="d-flex justify-content-between align-items-center">
                          <!-- Digit -->
                          <div>
                              <div class="fs-2 fw-bold text-end">1235</div>
                              <span class="mb-0 h6">POWER POINT</span>
                          </div>
                          <!-- Icon -->
                          <div class="icon-xl rounded-2 bg-secondary text-white mb-0"><i class="fa-regular fa-file-powerpoint fs-5"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-body card-overlay-bottom border-0 h-100" style="background-image:url({{asset('assets/plugins/forLayout/bgSub.jpg')}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
        <div class="row g-3 justify-content-between align-items-center mt-5 pt-5 position-relative z-index-9">
          <div class="col-lg-9">
            <h1 class="h3 mb-1 text-white">إضافة مادة دراسية جديدة</h1>
            <a class="text-white" href="http://school.local/assets/aaaswqw.png" target="_blank">يمكنك اضافة مادة دراسية جديد من هنا</a>
          </div>
          <!-- Button -->
          <div class="col-lg-3 text-lg-start">
            <a class="btn btn-light text-primary rounded-3 @error('subjectName') btn-danger @enderror @error('lever') btn-danger @enderror" id="btn-add" data-bs-toggle="modal" data-bs-target="#addNewSubject" href="#!">إضافة</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header border-0 pb-0">
      <h5 class="h5 mb-0">المواد الدراسية</h5>
    </div>
    <div class="card-body">
      @if(count($getSubject) > 0)
        @foreach ($getSubject as $subject)
          <div class="list-group mb-1 w-auto">
            <a href="{{url('school/admin/subject',['subject' => $subject->id ])}}" class="list-group-item list-group-item-action d-flex gap-3 p-2" aria-current="true">
                <div class="avatar avatar-md flex-shrink-0" width="32" height="32">
                  <div class="avatar-img rounded bg-{{$color}} bg-opacity-25">
                    <span class="text-{{$color}} position-absolute top-50 start-50 translate-middle fw-bold">
                      {{ mb_substr($subject->name, 0, 1) }}
                    </span>
                  </div>
                </div> 
              <div>
                <h6 class="mb-0">{{$subject->name}}</h6>
                @if($subject->selection == 0)
                <div class="text-scondary small">لا تدرس من قبل معلم</div>
                @endif
                @if($subject->selection == 1)
                <div class="text-scondary small">تدرس من قبل معلم</div>
                @endif
              </div>
              </a>
          </div>
        @endforeach
      @else
        <div class="h5 d-flex justify-content-center m-4">لم يتم إضافة اي مادة دراسية بعد</div>        
      @endif
    </div>
  </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="addNewSubject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="addNewSubject" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="d-flex justify-content-between alig align-items-center border-0 p-3">
        <h4 class="modal-title" id="addNewSubject">انشاء مادة دراسية</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 form" action="{{route('subject.store')}}" method="post" novalidate>
          @csrf
          <div class="col-md-12">
            <label class="form-label">اسم المادة</label>
            <input type="text" name="subjectName"  class="form-control @error('subjectName') is-invalid @enderror" placeholder="الرجاء ادخال إسم المادة الدراسية " 
            value="{{old('subjectName')}}">
            @error('subjectName')
            <div class="invalid-feedback">
            {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md-12">
            <label class="form-label">المستوى التعليمي</label>
            <select class="form-control form-select @error('level') is-invalid @enderror" name="level">
              <option> اختار ..</option>
              @for($type = 1 ; $type<=$typeOfSchool ; $type++)
              <option value="{{$type}}"> المستوى {{$type}}</option>
              @endfor
            </select>
            @error('level')
            <div class="invalid-feedback">
            {{$message}}
            </div>
            @enderror
          </div>
        <div class="text-center">
          <button type="submit" class="btn btn-sm btn-primary fs-6 col-md-12 mt-2">إنشاء</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection