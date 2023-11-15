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
<div class="col-lg-9">
  <div class="card mb-2">
    <!-- Card Start -->
    @if($getTeatcher->teatcherProfile != null)
    <div class="h-200px rounded-top" style="background-image:url({{asset('storage/'.$getTeatcher['teatcherProfile'])}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
    </div>
    @else
    <div class="h-200px rounded-top bg-{{$color}}"></div>
    @endif
    <div class="card-body py-0">
      <div class="d-sm-flex align-items-start text-center text-sm-end">
        <div>
          @if($getTeatcher->teatcherProfile != null)
          <div class="avatar avatar-xxl mt-n5 mb-3">
            <img class="avatar-img rounded-circle border border-white border-3"
              src="{{ asset('storage/'.$getTeatcher['teatcherProfile']) }}" alt="">
          </div>
          @else
          <div class="avatar avatar-xxl mt-n5 mb-3">
            <div class="avatar-img rounded-circle border border-white border-3 bg-{{$color}}">
              <span class="text-white position-absolute top-50 start-50 translate-middle fw-bold fs-2">
                {{ mb_substr($getTeatcher['firstName'], 0, 1) }} </span>
            </div>
          </div>
          @endif
          <!-- Avatar -->
        </div>
        <div class="me-sm-4 mt-sm-3">
          <h1 class="mb-0 h5">{{ $getTeatcher->firstName.' '.$getTeatcher->lastName }}
          </h1>
          <p>@ {{$getUser->name}}</p>
        </div>
        <!-- Button -->
        <div class="d-flex mt-3 justify-content-center me-sm-auto">
          <a class="btn btn-sm btn-outline-danger  ms-2" href="{{route('teatcher.edit',['teatcher' => $getTeatcher->id])}}">تعديل <i class="fa-solid fa-pencil pe-1"></i></a>
          <div class="dropdown">
            <!-- Card action menu -->
            <button class="icon-sm btn-sm btn btn-outline-dark" type="button" id="profileAction2" data-bs-toggle="dropdown"
              aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical p-1"></i></button>
            <!-- Card action dropdown menu -->
            <ul class="dropdown-menu dropdown-menu-end text-end" aria-labelledby="profileAction2">
              <li>
                <a class="dropdown-item" href="/school/admin/teatcher/settings/{{$getTeatcher->id}}">
                  <i class="fa-solid fa-gear ps-2"></i>الاعدادات المتقدمة
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  <i class="fa-solid fa-trash ps-2"></i>حذف
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- List profile -->
    </div>
    <!-- Card body END -->
    <div class="card-footer mt-3 pt-2 pb-0">
      <!-- Nav profile pages -->
      <ul class="nav nav-bottom-line align-items-center justify-content-center justify-content-md-start mb-0 border-0 pe-0">
        <li class="nav-item" role="presentation"> <a class="nav-link active" data-bs-toggle="tab" href="#group-tab-1">المواد الدرايسة</a> </li>
        <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" href="#group-tab-2">المستويات الدراسية</a> </li>
        <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" href="#group-tab-3">حول المعلم</a> </li>
      </ul>
    </div>
  </div><!-- Card END -->
  <div class="tab-content p-0 m-0">
    {{-- class="tab-pane show active fade" --}}
    <div class="tab-pane fade active show" id="group-tab-1">
      <div class="card card-body">
        <div class="my-sm-5 py-sm-5 text-center">
          <!-- Icon -->
          {{-- <i class=" bi bi-person"> </i> --}}
          <i class="fa-brands fa-medapps display-1 text-muted"></i>
          <!-- Title -->
          <h4 class="mt-2 mb-3 text-body">لم يتم تعين المعلم بعد</h4>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="group-tab-2">
      <div class="card card-body">
        <div class="my-sm-5 py-sm-5 text-center">
          <!-- Icon -->
          {{-- <i class="fa-brands fa-youtube"></i> --}}
          <i class="fa-brands fa-medapps display-1 text-muted"></i>
          <!-- Title -->
          <h4 class="mt-2 mb-3 text-body">لم يتم تعين المعلم بعد</h4>
        </div>
      </div>
    </div>

    <div class="tab-pane fade" id="group-tab-3">
      <div class="card card-body">
        <table class="table table-borderless">
          <tbody>
            <tr style="width:10px">
              <td>رقم المعلم</td>
              <td class="fw-bold">{{$getUser->id}}</td>
            </tr>
            <tr>
              <td>اسم المعلم</td>
              <td class="fw-bold">{{$getTeatcher->firstName}} {{$getTeatcher->lastName}} </td>
            </tr>
            <tr>
              <td>رقم الهاتف</td>
              <td class="fw-bold">{{$getTeatcher->phone}}</td>
            </tr>
            <tr>
              <td style="width:115px">البريد الإلكتروني</td>
              <td class="fw-bold">
                <a href="mailto:{{$getTeatcher->email}}" class="  text-decoration-none">{{$getTeatcher->email}}</a>
              </td>
            </tr>
            <tr>
              <td>عنوان المنزل</td>
              <td class="fw-bold">{{$getTeatcher->address}}</td>
            </tr>
            <tr>
              <td>تاريخ الاضافة</td>
              <td class="fw-bold">{{mb_substr($getTeatcher->created_at,0,10)}}</td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
@endsection
@section('modal')
<!-- start delete teatcher modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content rounded-3 shadow">
      <div class="modal-body text-center p-4 pb-2">
        <h5 class="mb-0 pb-2">حذف المعلم</h5>
        <p class="mb-0">سيتم حذف المعلم من سجلات الموقع هل انت متأكد</p>
      </div>
      
      <div class="modal-footer flex-nowrap text-center p-0">
        <form class="col-6" action="{{route('teatcher.destroy',['teatcher' => $getUser->id])}}" method="post">
          @csrf
          @method('DELETE')
          <button class="btn btn-lg fs-6 text-decoration-none m-0 rounded-0 text-denger"><strong class="text-danger">حذف</strong></button>
        </form>
        <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" data-bs-dismiss="modal">إلغاء</button>
      </div>
    </div>
  </div>
</div>
@endsection