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
    <div class="card row">
      <div class="card-body">
        <form class="row g-3 form" id="form" action="{{route('teatcher.store')}}" method="post" enctype="multipart/form-data" novalidate>
          @csrf
          <!-- logo -->
          <div class="col-md-12">
            <p class="text-secondary fw-semibold mb-1 mt-3">هنا البيانات العامة العامة للمعلم.</p>

            <label class="form-label">صورة الملف الشخصي <span class="text-muted">(اختياري)</span></label>
            <input type="file" class="form-control @error('teatcherProfile') is-invalid @enderror"
            name="teatcherProfile">
            @error('teatcherProfile')
              <div class="invalid-feedback">
              {{$message}}
              </div>
            @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">الاسم الاول</label>
            <input type="text" name="firstName"  class="form-control @error('firstName') is-invalid @enderror" placeholder="الرجاء ادخال اسم الاول" 
            value="{{old('firstName')}}">
            @error('firstName')
            <div class="invalid-feedback">
            {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">اسم الأب</label>
            <input type="text" name="lastName"  class="form-control @error('lastName') is-invalid @enderror" placeholder="الرجاء ادخال اسم الاب " 
            value="{{old('lastName')}}">
            @error('lastName')
            <div class="invalid-feedback">
            {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md-12">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control text-start @error('email') is-invalid @enderror" placeholder="ex@ex.com" value="{{old('email')}}">
            @error('email')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">العنوان<span class="text-muted">(اختياري)</span></label>
            <input type="text" name="address" class="form-control" placeholder="المدين , الحي" value="{{old('address')}}">
          </div>

          <div class="col-md-6">
            <label class="form-label">رقم الهاتف</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="ادخل رقم الهاتف بدون مفتاح الدولة" value="{{old('phone')}}">
            @error('phone')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md-12">
            <p class="text-secondary fw-semibold mb-1 mt-3">هنا بيانات الحساب المعلم هذة البيانات حساسة لا تشاركها مع الاخرين.</p>
            <label class="form-label">اسم المستخدم</label>
            <input type="text" name="userName" class="form-control @error('userName') is-invalid @enderror" placeholder="" value="{{old('userName')}}">
            @error('userName')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">كلمة المرور</label>
            <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="" value="{{old('password')}}">
            @error('password')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">تأكيد كلمة المرور</label>
            <input type="text" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="" value="{{old('password_confirmation')}}">
            @error('password_confirmation')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <input type="hidden" name="type" value="2">
          <!-- Button  -->
          <div class="col-md text-center">
            <button type="submit" class="btn btn-sm btn-primary fs-5 col-md-12 mt-2">إنشاء الحساب</button>
          </div>
        
        </form>
        <!-- Settings END -->
      </div>
      <!-- Card body END -->
    </div>
  </div>
@endsection