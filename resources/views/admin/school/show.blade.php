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
<div class="col-lg-9">
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
      <div class="toast mb-2 @error('title') show @enderror" role="alert" aria-live="assertive" aria-atomic="true" >
        <div class="toast-header">
          <i class="bg-danger rounded text-white p-1 ms-2 fa-solid fa-triangle-exclamation"></i>
          <strong class="text-danger">خطأ</strong>
          <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          لم يتم ارسال الرسالة  لوجود خطأ في عنوان الرسالة
        </div>
      </div>
      <div class="toast mb-2 @error('massege') show @enderror" role="alert" aria-live="assertive" aria-atomic="true" >
        <div class="toast-header">
          <i class="bg-danger rounded text-white p-1 ms-2 fa-solid fa-triangle-exclamation"></i>
          <strong class="text-danger">خطأ</strong>
          <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          لم يتم اسالة الرسالة لوجود خطأ في محتوى الرسالة
        </div>
      </div>
    </div>
  </div>
  <?php
    $num=rand(0,2);
    if ($num == 0)
    $color="secondary";
    elseif($num == 1)
      $color="info";
    else
      $color="dark";
    ?>
  <div class="card mb-3">
    @if($getSchool->schoolLogo != null)
    <div class="h-200px rounded-top" style="background-image:url({{asset('storage/'.$getSchool['schoolLogo'])}});
          background-position: center; background-size: cover; background-repeat: no-repeat;">
    </div>
    @else
    <div class="h-200px rounded-top bg-{{$color}}"></div>
    @endif
    <div class="card-body py-0">
      <div class="d-sm-flex align-items-start text-center text-sm-end">
        <div>
          @if($getSchool->schoolLogo != null)
          <div class="avatar avatar-xxl mt-n5 mb-3">
            <img class="avatar-img rounded-circle border border-white border-3"
              src="{{ asset('storage/'.$getSchool['schoolLogo']) }}" alt="">
          </div>
          @else
          <div class="avatar avatar-xxl mt-n5 mb-3">
            <div class="avatar-img rounded-circle border border-white border-3 bg-{{$color}}">
              <span class="text-white position-absolute top-50 start-50 translate-middle fw-bold fs-2"> {{
                mb_substr($getSchool['school_name'], 0, 1) }} </span>
            </div>
          </div>
          @endif
          <!-- Avatar -->
        </div>
        <div class="me-sm-4 mt-sm-3">
          <h1 class="mb-0 h5">{{ $getSchool->school_name }}
            
            @if($status == "unblock")
            <i class="fa-regular fa-circle-check text-success small"></i>
            @else
            <i class="fa-regular fa-circle-xmark text-danger small"></i>
            @endif
          </h1>
          <p>@ {{$getUser->name}}</p>
        </div>
        <!-- Button -->
        <div class="d-flex mt-3 justify-content-center me-sm-auto">
          <a class="btn btn-sm btn-outline-danger ms-2" href="{{route('school.edit',$getSchool->id)}}">تعديل
            <i class="fa-solid fa-pencil pe-1"></i>
          </a>
          <div class="dropdown">
            <!-- Card action menu -->
            <button class="icon-sm btn btn-outline-dark" type="button" id="profileAction2" data-bs-toggle="dropdown"
              aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical p-1"></i></button>
            <!-- Card action dropdown menu -->
            <ul class="dropdown-menu dropdown-menu-start text-end" aria-labelledby="profileAction2">
              <li>
                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#tamdedmodal"> <i class="fa-regular fa-calendar-plus ps-2"></i>تمديد فترة الإشتراك</button>
              </li>
              <li>
                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#notification"> <i class="fa-regular fa-message ps-2"></i>ارسال رسالة الى {{$getSchool->school_name}}</button>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item" href="/admin/school/schoolAction/editAdvansetSettings/{{$getSchool->id}}">
                  <i class="fa-solid fa-gear ps-2"></i>إعدادات متقدمة</a>
              </li>
              @if($subscriptionstatus != 0)
              <li>
                <a class="dropdown-item text-danger" href="/admin/school/schoolAction/chanselSubsc/{{$getSchool->id}}">
                  <i class="fa-regular fa-circle-xmark ps-2"></i>الغاء الإشتراك</a>
              </li>
              @endif
              <li>
                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  <i class="fa-solid fa-trash ps-2"></i>حذف المدرسة
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>

    </div>
    <!-- Card body END -->
    <div class="card-footer mt-3 pt-2 pb-0">
      <!-- Nav profile pages -->
      <ul class="nav nav-bottom-line align-items-center justify-content-center justify-content-md-start mb-0 border-0 pe-0">
        <li class="nav-item" role="presentation"> <a class="nav-link active" data-bs-toggle="tab" href="#group-tab-1">المعلمين</a> </li>
        <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" href="#group-tab-2">الطلاب</a> </li>
        <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" href="#group-tab-3">حول المدرسة</a> </li>
      </ul>
    </div>
  </div><!-- Card END -->
  <div class="tab-content p-0 m-0">
    {{-- class="tab-pane show active fade" --}}
    <div class="tab-pane fade active show" id="group-tab-1">
      <div class=" card card-body">
        @if(count($getTeatcher) > 0)
          @foreach ($getTeatcher as $teatcher)
            <div class="list-group mb-1 w-auto">
              <a class="list-group-item list-group-item-action d-flex gap-3 p-2" aria-current="true">
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
        <div class="my-sm-5 py-sm-5 text-center">
          <i class="fa-brands fa-medapps display-1 text-muted"></i>
          <!-- Title -->
          <h4 class="mt-2 mb-3 text-body">لم يتم تعين المعلم بعد</h4>
        </div>
        @endif
      </div>

    </div>
    <div class="tab-pane fade" id="group-tab-2">
      <div class="card card-body">
        <div class="my-sm-5 py-sm-5 text-center">

          <i class="fa-brands fa-medapps display-1 text-muted"></i>
          <!-- Title -->
          <h4 class="mt-2 mb-3 text-body">لا يوجد طالب</h4>
        </div>
      </div>
    </div>

    <div class="tab-pane fade" id="group-tab-3">
      <div class="card card-body">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td >رقم المدرسة</td>
              <td class="fw-bold">{{$getUser->id}}</td>
            </tr>
            <tr>
              <td>اسم المدرسة</td>
              <td class="fw-bold">{{$getSchool->school_name}}</td>
            </tr>
            <tr>
              <td>عنوان المدرسة</td>
              <td class="fw-bold">{{$getSchool->city_address}},{{$getSchool->town_address}}, {{$getSchool->street_address}}</td>
            </tr>
            <tr>
              <td style="width:160px">نوع المؤسسة التعليمية</td>
              <td class="fw-bold">{{$getSchool->type_of}}</td>
            </tr>
            <tr>
              <td>رقم الهاتف</td>
              <td class="fw-bold">{{$getSchool->phone}}</td>
            </tr>
            <tr>
              <td style="width:115px">البريد الإلكتروني</td>
              <td class="fw-bold">
                <a href="mailto:{{$getSchool->email}}" class="text-decoration-none text-info">{{$getSchool->email}}</a>
              </td>
            </tr>
            <tr>
              <td>تاريخ الاضافة</td> 
              <td class="fw-bold">{{mb_substr($getSchool->created_at,0,10)}}</td>
            </tr>
            <tr>
              <td>حالة الاشتراك</td>
              @if($subscriptionstatus == 0)
              {{$subscriptionstatus = 'تم انتهاء الاشتراك';}}
              @endif
              <td class="fw-bold text-danger"> {{$subscriptionstatus}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@section('modal')
<!-- Modal تمديد -->
<div class="modal fade" id="tamdedmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="tamdedmodal" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="d-flex justify-content-between alig align-items-center border-0 p-3">
        <h1 class="modal-title fs-5" id="tamdedmodal">تمديد فترة الاشتراك</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="schoolAction/updateDate/{{$getSchool->id}}" method="POST">
          @csrf
          <label for="state" class="form-label">الرجاء اختيار عدد الاشهر المراد إضافتها <i
              class="fa-regular fa-circle-question"></i> </label>
          <select class="form-select" id="" required="" name="subscription">
            <option value="">اختر...</option>
            @for($i=1 ; $i<=12 ; $i++)
            <option value="{{$i}}">{{$i}}</option>
          @endfor
          </select>
      </div>
      <div class="modal-footer border-0">
        <button class="btn btn-primary w-100" type="submit">تمديد</button>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- Send Notification modal --}}
<div class="modal fade" id="notification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="notification" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="d-flex justify-content-between alig align-items-center border-0 p-3">
        <h1 class="modal-title fs-5" id="notification">إرسال رسالة</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/admin/school/sendMassegeToSchoolAdmin/{{$getUser->id}}" method="POST">
          @csrf
          <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="عنوان الرسالة ..." value="{{old('title')}}">
          @error('title')
          <div class="invalid-feedback">
          {{$message}}
          </div>
          @enderror
          <div class="w-100 position-relative mt-3">
            <button class="nav-link bg-transparent px-3 position-absolute top-50 end-0 translate-middle-y border-0" type="submit">
              <i class="text-primary fa-solid fa-paper-plane"></i>            </button>
            <textarea data-autoresize class="form-control pe-5 @error('massege') is-invalid @enderror" rows="1" placeholder="محتوى الرسالة ..." name="massege" style="overflow-y: hidden" value="{{old('massege')}}"></textarea>
          </div>
          @error('massege')
          <div class="invalid-feedback">
          {{$message}}
          </div>
          @enderror
      </div>
      </form>
    </div>
  </div>
</div>
{{-- Send Notification modal --}}

<!-- start delete school modal -->
<div class="modal fade modal-alert" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content rounded-3 shadow">
      <div class="modal-body text-center p-3">
        <h5 class="mb-0">حذف هذه المدرسة?</h5>
        <p class="mb-0">سيتم حذف جميع حسابات المعلمين و الطلاب و ايضاً جميع الملفات و محتويات المدرسة هل انت متأكد ?.</p>
      </div>
      <div class="modal-footer flex-nowrap p-0">
        <form class="btn m-0  col-6 m-0 rounded-0 border-start" action="{{route('school.destroy',$getUser->id)}}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-link btn-lg fs-6 text-decoration-none text-danger pt-0 pb-0">حذف</button>
        </form>
        <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 pt-0 pb-0" data-bs-dismiss="modal" data-bs-dismiss="modal">الغاء</button>
      </div>
    </div>
  </div>
</div>
@endsection