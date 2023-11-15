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
    <!-- Main content START -->
    <div class="col-lg-9">
      <div class="card mb-3">
        @if($getTeatcher->teatcherProfile != null)
        <div class="h-200px rounded-top"
        style="background-image:url({{asset('storage/'.$getTeatcher['teatcherProfile'])}});
        background-position: center; background-size: cover; background-repeat: no-repeat;">
      </div>
        @else
        <div class="h-200px rounded-top bg-{{$color}}"></div>
        @endif
        <!-- Card body START -->
        <div class="card-body py-0">
          <div class="d-sm-flex align-items-start text-center text-sm-end">
            @if($getTeatcher->teatcherProfile != null)
              <div class="avatar avatar-xxl mt-n5">
                <img class="avatar-img avatar-img rounded-circle border border-white border-3" src="{{ asset('storage/'.$getTeatcher['teatcherProfile']) }}">
                <div class="input-group text-edit justify-content-center">
                  <a href="/adminSchool/teatcher/AdminSchoolActionController/removeImage/{{$getTeatcher->id}}" class="btn text-white input-group-text ps-1 border-start pt-2 pb-0">حذف</a>
                  <label class=" btn text-white input-group-text pe-1 pt-2 pb-0 " for="uploadfile-1">تعديل</label>
                </div>
              </div>
            @else
                <!-- Avatar place holder -->
                <div class="d-flex justify-content-center align-items-center flex-column mb-3">
                  <div class="avatar avatar-xxl mt-n5">
                    <div class="avatar-img rounded-circle border border-white border-3 bg-{{$color}}">
                      <span class="text-white position-absolute top-50 start-50 translate-middle fw-bold fs-2"> {{ mb_substr($getTeatcher['firstName'], 0, 1) }} </span>
                    </div>
                    <label class="btn text-edit" for="uploadfile-1">إضافة</label>
                  </div>
                </div>
                @endif
              <!-- Upload button -->
              <form  action="{{route('teatcher.update',['teatcher'=>$getTeatcher->id])}}" enctype="multipart/form-data" novalidate method="POST">

              <input name="teatcherProfile" id="uploadfile-1" class="form-control @error('teatcherProfile') is-invalid @enderror d-none" type="file">
              @error('teatcherProfile')
              <div class="invalid-feedback">
              {{$message}}
              </div>
              @enderror
            <div class="me-sm-4 mt-sm-3">
              <!-- Info -->
              <h1 class="mb-0 h5">{{ $getTeatcher->firstName .' '. $getTeatcher->lastName }}
              </h1>
              <p>@ {{$getUser->name}} </p>
              <div>
              </div>
            </div>
          </div>
        </div>
        <!-- Card body END -->
      </div>
      <div class="card">
        <div class="card-header border-0 pb-0">
          <h5 class="card-title">بيانات الملف الشخصي للمدرسة</h5>
        </div>
        <div class="card-body">
          <div class="row g-3">
            @csrf
            @method('PUT')
            <div class="col-lg-12 mt-0">
              <p class="text-secondary fw-semibold mb-1 mt-3">هنا البيانات العامة العامة للمعلم.</p>
            </div>
              <div class="col-md-6">
                <label class="form-label">الاسم الاول</label>
                <input type="text" name="firstName"  class="form-control @error('firstName') is-invalid @enderror" placeholder="الرجاء ادخال اسم الاول" 
                value="{{$getTeatcher->firstName}}">
                @error('firstName')
                <div class="invalid-feedback">
                {{$message}}
                </div>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label">اسم الأب</label>
                <input type="text" name="lastName"  class="form-control @error('lastName') is-invalid @enderror" placeholder="الرجاء ادخال اسم الاب " 
                value="{{$getTeatcher->lastName}}">
                @error('lastName')
                <div class="invalid-feedback">
                {{$message}}
                </div>
                @enderror
              </div>
              <div class="col-md-12">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control text-start @error('email') is-invalid @enderror" placeholder="ex@ex.com" value="{{$getTeatcher->email}}">
                @error('email')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label">العنوان<span class="text-muted">(اختياري)</span></label>
                <input type="text" name="address" class="form-control" placeholder="المدين , الحي" value="{{$getTeatcher->address}}">
              </div>
    
              <div class="col-md-6">
                <label class="form-label">رقم الهاتف</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="ادخل رقم الهاتف بدون مفتاح الدولة" value="{{$getTeatcher->phone}}">
                @error('phone')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
              <div class="col-md text-center">
                <button type="submit" class="btn btn-sm btn-primary fs-5 col-md-12 mt-2">تعديل</button>
              </div>
          </form>
        </div>
      </div>
    </div>
@endsection