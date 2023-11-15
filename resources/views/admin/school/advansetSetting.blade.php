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
    <div class="card mb-2">
      <div class="card-header border-0 pb-0">
        <h5 class="card-title">اعدادات الوصول</h5>
      </div>
      <div class="card-body">
        <ul class="list-group list-group-flush p-0">
          <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
            <div>
              <h6 class="mb-0">حظر</h6>
              <p class="small mb-0 text-danger">تنبية عند تفعيل هذا الوضع سيتم منع كل مستخدمين المدرسة من
                الوصول إلى المنصة التعليمية</p>
            </div>
            <form action="/admin/school/schoolAction/statusSchool/{{$getSchool->id}}" method="POST">
              @csrf
              <div class="form-check form-switch">
                <input class="form-check-input" name="status" type="checkbox" role="switch" @if($getSchool->status != 0) checked @endif>
              </div>
            </li>
          </ul>
        </div>
        <div class="card-footer pt-0 text-start border-0">
          <button type="submit" class="btn btn-sm btn-primary mb-0">حفظ التقيرات</button>
        </form>
      </div>
    </div>
    <div class="card mb-2">
      <div class="card-header border-0 pb-0">
        <h5 class="card-title">تغير اسم المستخدم</h5>
      </div>
      <div class="card-body">
        <form action="/admin/school/schoolAction/updateUserName/{{$getUser->id}}" method="POST">
          @csrf
          {{-- @method('PUT') --}}
          <label for="username" class="form-label">اسم المستخدم</label>
          <div class="input-group">
            <span class="input-group-text">@</span>
            <input type="text" name="userName" class="form-control @error('userName') is-invalid @enderror" placeholder="اسم المستخدم" value="{{$getUser->name}}">
            @error('userName')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
        </div>
        <div class="card-footer pt-0 text-start border-0">
          <button type="submit" class="btn btn-sm btn-primary mb-0">حفظ التقيرات</button>
        </form>
      </div>
    </div>

    <div class="card">
      <!-- Title START -->
      <div class="card-header border-0 pb-0">
        <h5 class="card-title">تغير كلمة المرور</h5>
      </div>
      <!-- Title START -->
      <div class="card-body">
        <!-- Settings START -->
        
        <form action="/admin/school/schoolAction/updatePassword/{{$getUser->id}}" method="POST" class="row g-3">
          @method('POST')
          @csrf
          <!-- Current password -->
          <div class="col-12">
            <label class="form-label">كلمة المرور القديمة</label>
            <div class="input-group">
              <span class="input-group-text input-group-text-border-handel p-0">
                <i class="fakepasswordicon fa-solid fa-eye-slash cursor-pointer p-2" id="psw_input_icon" onclick="showAndHidePass()"></i>
              </span>
              <input type="password" name="oldPassword" id="psw_input_old"
              class="form-control @error('oldPassword') is-invalid @enderror" placeholder="ادخل كلمةالمرور القديمة" value="{{old('oldPassword')}}">
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
          <div class="col-12 text-start">
            <button type="submit" class="btn btn-sm btn-primary mb-0">تغير كلمة المرور</button>
          </div>
        </form>
        <!-- Settings END -->
      </div>
    </div>
    <!-- Notification END -->
  </div>

@endsection