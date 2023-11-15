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
      <div class="card">
        <!-- Card body START -->
        <div class="card-body">
          <div class="d-md-flex flex-wrap align-items-start text-center text-md-end">
            <div class="ms-md-4 mt-3">
              <!-- Info -->
              <h1 class="h5 mb-0"> {{$getSubject->name}} @if($getSubject->selection == 1 || $getSubject->selection != null)<i class="fa-regular fa-circle-check text-success small"></i>
                @else
                <i class="fa-regular fa-circle-xmark text-danger small"></i>
                @endif</h1>
              <ul class="nav nav-divider justify-content-center pe-0 justify-content-md-end">
                @if($getSubject->selection == 1)
                <li class="nav-item"> {{$getTeatcher->firstName .' '. $getTeatcher->lastName}} </li>
                @endif
                <li class="nav-item"> المستوى التعليمي {{$getSubject->level}}</li>
              </ul>
            </div>
            <!-- Button -->
            <div class="d-flex justify-content-center justify-content-md-end align-items-center mt-3 me-lg-auto">
              @if($getSubject->selection == 0 || $getSubject->selection == null)
                <button class="btn btn-sm bg-primary bg-opacity-10 text-primary ms-2 ms-lg-2" type="button" data-bs-toggle="modal" data-bs-target="#addTeatcher">
                <i class="fa-solid fa-chalkboard-user ps-1"></i>تعين معلم</button>
              @endif
              <button class="btn btn-sm  btn-outline-danger ms-2" type="button" data-bs-toggle="modal" data-bs-target="#addNewSubject"> <i class="fa-solid fa-pen ps-1"></i> تعديل</button>
              <div class="dropdown">
                <!-- Group share action menu -->
                <button class="icon-sm btn btn-sm btn-outline-dark" type="button" id="groupAction" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-ellipsis"></i>
                </button>
                <!-- Group share action dropdown menu -->
                <ul class="dropdown-menu dropdown-menu-end text-end" aria-labelledby="groupAction">
                  @if($getSubject->selection == 1 || $getSubject->selection != null)
                  <li>
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unTeatcher"><i class="fa-solid fa-ban ms-1"></i>إلغاء تعين المعلم</a></li></button>
                  </li>
                  @endif
                  <li><a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteSubject"> <i class="fa-solid fa-trash ms-1"></i>حذف</a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- Join group START -->
          <ul class="avatar-group list-unstyled justify-content-center justify-content-md-start align-items-center mb-0 mt-3 flex-wrap">
            @foreach($getUser as $teatcher)
            @if($teatcher->teatcherProfile != null)
            <li class="avatar avatar-xs">
              <img class="avatar-img rounded-circle" src="{{asset('storage/'.$teatcher->teatcherProfile)}}" alt="avatar">
            </li>
              @endif
              @endforeach

              @if ($teatcher->teatcherProfile != null)
              <li class="avatar avatar-xs">
                <div class="avatar-img rounded-circle bg-primary text-white text-center">
                  <div class="mt-1">
                    1+
                  </div>
                </div>    
              </li>
              @endif
          </ul>
          <!-- Join group END -->
        </div>
        <!-- Card body END -->
        <div class="card-footer pb-0">
          <ul class="nav nav-tabs nav-bottom-line justify-content-center justify-content-md-start pe-0 mb-0" role="tablist">
            <li class="nav-item" role="presentation"> <a class="nav-link active" data-bs-toggle="tab" href="#group-tab-1"> المحتوى التعليمي <span class="badge bg-success bg-opacity-10 text-success small"> 230</span> </a> </li>
            <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" href="#group-tab-2" aria-selected="false" tabindex="-1" role="tab"><i class="fa-solid fa-video"></i> فيديو <span class="badge bg-success bg-opacity-10 text-success small"> 230</span> </a> </li>
            <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" href="#group-tab-3" aria-selected="false" tabindex="-1" role="tab"><i class="fa-regular fa-file-pdf"></i> PDF <span class="badge bg-success bg-opacity-10 text-success small"> 230</span> </a> </li>
            <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" href="#group-tab-4" aria-selected="false" tabindex="-1" role="tab"><i class="fa-regular fa-file-powerpoint"></i> Power Poient <span class="badge bg-success bg-opacity-10 text-success small"> 230</span> </a> </li>
            <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" href="#group-tab-5" aria-selected="false" tabindex="-1" role="tab"><i class="fa-solid fa-q"></i> quiz</a> </li>
            <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" href="#group-tab-6" aria-selected="false" tabindex="-1" role="tab"><i class="fa-solid fa-exclamation"></i> حول المادة</a> </li>
          </ul>
        </div>
      </div>
      <div class="tab-content p-0 m-0">
        {{-- class="tab-pane show active fade" --}}
        <div class="tab-pane fade active show" id="group-tab-1">
          <div class="card card-body">
            <div class="my-sm-5 py-sm-5 text-center">
              <!-- Icon -->
              {{-- <i class=" bi bi-person"> </i> --}}
              <i class="fa-brands fa-medapps display-1 text-muted"></i>
              <!-- Title -->
              <h4 class="mt-2 mb-3 text-body">لا يوجد محتوى تعليمي بعد</h4>
            </div>
          </div>
        </div>
  
        <div class="tab-pane fade" id="group-tab-2">
          <div class="card card-body">
            <div class="my-sm-5 py-sm-5 text-center">
              <!-- Icon -->
              {{-- <i class="fa-brands fa-youtube"></i> --}}
              <i class="fa-brands fa-youtube display-1 text-muted"></i>
              <!-- Title -->
              <h4 class="mt-2 mb-3 text-body">لا يوجد فيديو بعد</h4>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="group-tab-3">
          <div class="card card-body">
            <div class="my-sm-5 py-sm-5 text-center">
              <!-- Icon -->
              <i class="fa-regular fa-file-pdf display-1 text-muted"></i>
              <!-- Title -->
              <h4 class="mt-2 mb-3 text-body">لا يوجد PDF بعد</h4>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="group-tab-4">
          <div class="card card-body">
            <div class="my-sm-5 py-sm-5 text-center">
              <!-- Icon -->
              <i class="fa-regular fa-file-powerpoint display-1 text-muted"></i>
              <!-- Title -->
              <h4 class="mt-2 mb-3 text-body">لا يوجد Power Point بعد</h4>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="group-tab-5">
          <div class="card card-body">
            <div class="my-sm-5 py-sm-5 text-center">
              <!-- Icon -->
              <i class="fa-solid fa-question display-1 text-muted"></i>
              <!-- Title -->
              <h4 class="mt-2 mb-3 text-body">لا يوجد quiz بعد</h4>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="group-tab-6">
          <div class="card card-body">
            <table class="table table-borderless">
              <tbody>
                <tr>
                  <td style="width:100px">رقم المادة</td>
                  <td class="fw-bold">{{$getSubject->id}}</td>
                </tr>
                <tr>
                  <td>اسم المادة</td>
                  <td class="fw-bold">{{$getSubject->name}}</td>
                </tr>
              </tbody>
            </table>
    
          </div>
        </div>
      </div>
    </div>
@endsection

@section('modal')
<div class="modal fade" id="addTeatcher" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="addTeatcher" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="d-flex justify-content-between alig align-items-center border-0 p-3">
        <h4 class="modal-title" id="addTeatcher">تعين معلم لهاذة المادة</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 form" action="/admin/school/SubjectActionController/addTeacherForSubject/{{$getSubject->id}}" method="POST" novalidate>
          {{-- @method('PUT') --}}
          @csrf
          <div class="col-md-12">
            <label class="form-label">المعلمين المتاحين حالياً</label>
            <select class="form-control form-select" name="teatcherSelected">
              @foreach($getAllTeatcher as $teatcher)
              <option value="{{$teatcher->id}}">{{$teatcher['firstName'] .' '. $teatcher['lastName']}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md text-center">
            <button type="submit" class="btn btn-sm btn-primary fs-6 col-md-12 mt-2">تعين</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="unTeatcher" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content rounded-3 shadow">
      <div class="modal-body text-center p-4">
        <h5 class="mb-0 pb-3">إلغاء تعين المعلم</h5>
        <p class="mb-0">سيتم إلغاء تعين المعلم لهاذة المادة الدراسية هل انتى متأكد.</p>
      </div>
      <div class="modal-footer flex-nowrap p-0">
        <a href="/admin/school/SubjectActionController/removeTeacherForSubject/{{$getSubject->id}}" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0"><strong>تأكيد</strong></a>
        <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" data-bs-dismiss="modal">إلغاء</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteSubject" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content rounded-3 shadow">
      <div class="modal-body text-center p-4">
        <h5 class="mb-0 pb-3">حذف المادة الدراسية</h5>
        <p class="mb-0">سيتم حذف المحتوى التعليمي التي تم إضافتة في هذة المادة</p>
      </div>
      
      <div class="modal-footer flex-nowrap text-center p-0">
        <form class="col-6" action="{{route('subject.destroy',$getSubject->id)}}" method="post">
          @csrf
          @method('DELETE')
          <button class="btn btn-lg fs-6 text-decoration-none m-0 rounded-0 text-denger"><strong class="text-danger">حذف</strong></button>
        </form>
        <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" data-bs-dismiss="modal">إلغاء</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addNewSubject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="addNewSubject" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="d-flex justify-content-between alig align-items-center border-0 p-3">
        <h4 class="modal-title" id="addNewSubject">تعديل مادة دراسية</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 form" action="{{route('subject.update',$getSubject->id)}}" method="POST" novalidate>
          @method('PUT')
          @csrf
          <div class="col-md-12">
            <label class="form-label">اسم المادة</label>
            <input type="text" name="subjectName"  class="form-control @error('subjectName') is-invalid @enderror" placeholder="الرجاء ادخال إسم المادة الدراسية " 
            value="{{$getSubject->name}}">
            @error('subjectName')
            <div class="invalid-feedback">
            {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md-12">
            <label class="form-label">المستوى التعليمي</label>
            <select class="form-control form-select @error('level') is-invalid @enderror" name="level">
              <option value="1">المستوى الاول</option>
              <option value="2">المستوى الثاني</option>
              <option value="3">المستوى الثالث</option>
            </select>
            @error('level')
            <div class="invalid-feedback">
            {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md text-center">
            <button type="submit" class="btn btn-sm btn-primary fs-6 col-md-12 mt-2">تعديل</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection