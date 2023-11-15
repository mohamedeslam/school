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
    <div class="card row">
      <!-- Title START -->
      <div class="card-header border-0 pb-0">
        <h1 class="h5 card-title text-primary">بيانات المدرسة</h1>
        <p class="mb-0">هنا البيانات العامة .</p>
      </div>
      <!-- Card header START -->
      <!-- Card body START -->
      <div class="card-body">
        <!-- Form settings START -->
        <form class="row g-3 form" id="form" action="{{route('school.store')}}" method="post" enctype="multipart/form-data" novalidate>
          @csrf
          <!-- logo -->
          <div class="col-md-6">
            <label class="form-label">شعار المدرسة <span class="text-muted">(اختياري)</span></label>
            <input type="file" class="form-control pe-1 @error('logo') is-invalid @enderror"
            name="logo" value="{{old('logo')}}">
            @error('logo')
              <div class="invalid-feedback">
              {{$message}}
              </div>
              @enderror
          </div>
          <!-- School name -->
          <div class="col-md-6">
              <label class="form-label">إسم المدرسة</label>
              <input type="text" name="school_name"  class="form-control @error('school_name') is-invalid @enderror" placeholder="الرجاء ادخال اسم المدرسة فقط" 
              value="{{old('school_name')}}">
              @error('school_name')
              <div class="invalid-feedback">
              {{$message}}
              </div>
              @enderror
          </div>
          <!-- number of instructer -->
          <div class="col-md-6">
            <label class="form-label">عدد المعلمين <span class="text-muted">(اختياري)</span></label>
            <input type="number" name="num_teachers" class="form-control" placeholder=""value="{{old('num_teachers')}}">
          </div>

          <!-- number of student -->
          <div class="col-md-6">
            <label class="form-label">عدد الطلاب <span class="text-muted">(اختياري)</span></label>
            <input type="number" name="num_students" class="form-control" placeholder="" value="{{old('num_students')}}">
          </div>
          <!-- phone number -->
          <div class="col-md-6">
            <label class="form-label">رقم الهاتف</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="ادخل رقم الهاتف بدون مفتاح الدولة" value="{{old('phone')}}">
            
            @error('phone')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="" value="{{old('email')}}">
            @error('email')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md-12">
            <label class="form-label">عنوان المدرسة</label>
            <div class="row">
              <div class="col-md-4 mt-1">
                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="المدينة" value="{{old('city')}}">
                @error('city')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
              <div class="col-md-4 mt-1">
                <input type="text" name="town" id="town" class="form-control @error('town') is-invalid @enderror" placeholder="الحي" value="{{old('town')}}">
                @error('town')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
              <div class="col-md-4 mt-1">
                <input type="text" name="street" id="street" class="form-control @error('street') is-invalid @enderror" placeholder="الشارع" value="{{old('street')}}">
                @error('street')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <label class="form-label  mb-0">نوع المؤسسة التعليمية</label>
            <div>
              <div class="form-check d-inline-block ">
                <label class="form-check-label ms-1" for="typeOne">اساس</label>
                <input id="typeOne" name="type_of" type="radio" class="form-check-input" checked=""
                  value="اساس">
              </div>
              <div class="form-check d-inline-block me-1">
                <label class="form-check-label ms-1" for="typetow">ثانوي</label>
                <input id="typetow" name="type_of" type="radio" class="form-check-input"  value="ثانوي">
              </div>
            </div>
          </div>
          <div class="col-12">
            <label class="form-label">نبذة عن المدرسة <span class="text-muted">(اختياري)</span></label>
            <textarea class="form-control @error('about') is-invalid @enderror" name="about" rows="4" placeholder="تكلم عن المدرسة بإجاذ"></textarea>
            @error('about')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md-12 mb-0">
            <div class="card-header border-0 p-0">
              <h1 class="h5 card-title text-primary">بيانات الاشتراك</h1>
            </div>
          </div>
          <div class="col-md-12 mt-0">
              <label for="subscription" class="form-label">الرجاء اختيار عدد اشهر الاشتراك </label>
              <select class="form-select form-control @error('subscription')
              is-invalid @enderror" name="subscription" id="subscription">
                <option>الرجاء الإختيار</option>
                @for($i=1;$i<=12;$i++)
                <option value="{{$i}}">{{$i}}</option>
                @endfor
              </select>
              @error('subscription')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
          </div>
          <div class="col-md-12">
            <h1 class="h5 card-title text-primary mt-1 mb-1">بيانات الحساب</h1>
            <label class="form-label">اسم المستخدم</label>
            <input type="text" name="user_name" class="form-control @error('user_name') is-invalid @enderror" placeholder="" value="{{old('user_name')}}">
            @error('user_name')
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