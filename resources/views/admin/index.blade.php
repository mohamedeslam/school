{{-- @Session('schoolID'); --}}
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
    <div class="row">
        <div class="col-12 mb-3">
            <h1 class="h3 mb-2 mb-sm-0 text-secondary">لوحة التحكم</h1>
        </div>
    </div>
    <div class="row g-2">
        <div class="col-md-6">

          <div class="card card-body card-overlay-bottom border-0 h-100" style="background-image:url({{asset('assets/aaaswqw.png')}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
            <!-- Card body START -->
            
            <!-- Event name START -->
            <div class="row g-3 justify-content-between align-items-center mt-5 pt-5 position-relative z-index-9">
              <div class="col-lg-9">
                <h1 class="h3 mb-1 text-white">انشاء حساب جديد</h1>
                <a class="text-white" href="{{asset('assets/aaaswqw.png')}}" target="_blank">يمكنك اضافة مدرسة جديد من هنا</a>
              </div>
              <!-- Button -->
              <div class="col-lg-3 text-lg-start">
                <a class="btn btn-light text-primary rounded-3" href="#!">إنشاء</a>
              </div>
            </div>
            <!-- Event name END -->
          </div>
        </div>

        <div class="col-md-6">
          <div class="crad">
            <div class="card-body p-0">
              <div class="bd-example-snippet bd-code-snippet">
                <div class="bd-example">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-label="الشريحة الأولى" aria-current="true"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="الشريحة الثانية" class=""></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="الشريحة الثالثة" class=""></button>
                  </div>
                  <div class="carousel-inner rounded-3">
                    <div class="carousel-item active">
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
                    <div class="carousel-item">
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
                      <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="227" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: الشريحة الثالثة" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#fff"></rect><text x="50%" y="20%" fill="#6c757d" dy=".3em">اهم الإحصائيات</text></svg>
                      
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
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header border-0 pb-0">
                <h5 class="h5 mb-0">المدارس</h5>
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
                  <div class="my-sm-5 py-sm-5 text-center">
                  <i class="fa-solid fa-school-circle-exclamation fs-1 text-muted p-3"></i>
                    <div class="fw-bold text-muted">لم يتم إضافة اي مدرسة بعد</div>
                  </div>
                  @endif
                </div>
              </div>
        </div>
    </div>
  </div>
</div>
@endsection


