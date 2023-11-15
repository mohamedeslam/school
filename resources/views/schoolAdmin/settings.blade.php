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
  <div class="card mb-4">
    <div class="card-header border-0 pb-0">
      <h1 class="h5 card-title">اعددات المدرسة</h1>
      <p class="mb-0">يمكنك تعديل اسم المدرسة و معلومات التواصل و عنوان المدرسة من هنا " هذة المعلومات ستظهر على الصفحة الرئيسية للمدرسة لذلك يجب ان تكون دقيقة " </p>
    </div>
    <div class="card-body">
      <form action="/school/admin/settings/updateSchoolInformation/{{$school->id}}" method="POST" class="row g-3" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="col-lg-12">
          <label class="form-label">شعار المدرسة</label>
          <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
          @error('logo')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
        <div class="col-lg-6">
          <label class="form-label">اسم المدرسة</label>
          <input type="text" name="school_name" class="form-control @error('school_name') is-invalid @enderror" placeholder="الرجاء ادخال اسم المدرسة فقط" value="{{$school->school_name}}">
          @error('school_name')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
        <div class="col-lg-6">
          <label class="form-label">نوع المؤسسمة التعليمية <span class="text-muted small">(لا يمكن التعديل هنا)</span></label>
          <input type="text" class="form-control flatpickr flatpickr-input" value="{{$school->type_of}}" readonly="readonly">
        </div>
        <div class="col-sm-12 col-lg-12 pb-0 mb-0">
          <label class="form-label fw-bold">عنوان المدرسة</label>
        </div>
        <div class="col-sm-6 col-lg-6 mt-lg-0">
          <label class="form-label">المدينة</label>
          <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
          value="{{$school->city_address}}">
          @error('city')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
        <div class="col-sm-6 col-lg-3 mt-lg-0">
          <label class="form-label">الحي</label>
          <input type="text" name="town" class="form-control @error('town') is-invalid @enderror"
          value="{{$school->town_address}}">
          @error('town')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
        <div class="col-sm-6 col-lg-3 mt-lg-0">
          <label class="form-label">اسم الشارع</label>
          <input type="text" name="street" class="form-control @error('street') is-invalid @enderror" value="{{$school->street_address}}">
          @error('street')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>

        <div class="col-sm-12 col-lg-12 pb-0 mb-0">
          <label class="form-label fw-bold">معلومات التواصل</label>
        </div>

        <div class="col-lg-8">
          <label class="form-label">
              البريد الالكتروني
          </label>
          <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="ex@ex.com" value="{{$school->email}}">
          @error('email')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>

        <div class="col-lg-4 ">
          <label class="form-label">
              رقم الهاتف</label>
          <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="الرجاء ادخال رقم الهاتف بدون مفتاح الدولة" value="{{$school->phone}}">
          @error('phone')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
        <div class="col-12">
          <label class="form-label">نبذة عن المدرسة</label>
          <textarea class="form-control @error('about') is-invalid @enderror" name="about" rows="4" placeholder="تكلم عن المدرسة بإجاذ">{{$school->about_school}}</textarea>
          @error('about')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-sm btn-primary mb-0">حفظ التغيرات</button>
        </div>
      </form>
    </div>
  </div>
  <div class="card mb-1">
    <div class="card-header border-0 pb-0">
      <h1 class="h5 card-title">اعددات الحساب</h1>
      <p class="mb-0">يمكنك تعديل اسم المستخدم و كلمة المرور  "هذة المعلومات حساسة احذر من مشاركتها مع اي شخص اخر" .</p>
    </div>

    <!-- Card body START -->
    <div class="card-body">
      <form action="/school/admin/setting/updateUserName/{{$user->id}}" method="POST">
        @csrf

        <label for="username" class="form-label">اسم المستخدم</label>
        <div class="input-group">
          <span class="input-group-text @error('userName') btn btn-danger @enderror">@</span>
          <input type="text" name="userName" class="form-control @error('userName') is-invalid @enderror" placeholder="اسم المستخدم" value="{{$user->name}}">
          @error('userName')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
      </div>
        <div class="card-footer pt-0 border-0">
          <button type="submit" class="btn btn-sm btn-primary">حفظ التقيرات</button>
        </div>
    </form>
  </div>
  <div class="card">
    <div class="card-body">
      <form action="/school/admin/setting/updatePassword/{{$user->id}}" method="POST" class="row g-3">
        @csrf
        <!-- Current password -->
        <div class="col-12">
          <label class="form-label">كلمة المرور القديمة</label>
          <div class="input-group">
            <span class="input-group-text input-group-text-border-handel p-0">
              <i class="fakepasswordicon fa-solid fa-eye-slash cursor-pointer p-2" id="psw_input_icon" onclick="showAndHidePass()"></i>
            </span>
            <input type="password" name="oldPassword" id="psw_input_old"
            class="form-control @error('oldPassword') is-invalid @enderror" placeholder="ادخل كلمةالمرور القديمة" value="">
            @if(session()->has('passowdDontAdd'))
            <div class="invalid-handel">
              {{session()->get('passowdDontAdd')}}
            </div>
            @endif
            @error('oldPassword')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
        </div>
        <!-- New password -->
        <div class="col-12">
          <label class="form-label">كلمة المرور المرور الجديدة</label>
            <input type="password" name="newPassword" id="psw_input_new" class="form-control @error('newPassword') is-invalid @enderror"  placeholder="ادخل كلمةالمرور الجديدة" value="{{old('newPassword')}}">
            @error('newPassword')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
        </div>
        <!-- Confirm password -->
        <div class="col-12">
          <label class="form-label">تأكيد كلمة المرور</label>
          <input type="password" name="newPassword_confirmation" id="pswinput_confirm" class="form-control @error('newPassword_confirmation') is-invalid @enderror" placeholder="تأكيد كلمة المرور" value="{{old('newPassword_confirmation')}}">
          @error('newPassword_confirmation')
            <div class="invalid-feedback">
              {{$message}}
            </div>
          @enderror
        </div>
        <!-- Button  -->
        <div class="col-12">
          <button type="submit" class="btn btn-sm btn-primary">تغير كلمة المرور</button>
        </div>
      </form>
  </div>
</div>
@endsection