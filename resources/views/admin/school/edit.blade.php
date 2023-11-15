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
    <!-- Main content START -->
    <div class="col-lg-9">
      <div class="card mb-3">
        <?php
        $num=rand(0,2);
        if ($num == 0)
        $color="secondary";
        elseif($num == 1)
          $color="info";
        else
          $color="dark";
        ?>
        @if($school->schoolLogo != null)
        <div class="h-200px rounded-top"
        style="background-image:url({{asset('storage/'.$school['schoolLogo'])}});
        background-position: center; background-size: cover; background-repeat: no-repeat;">
        </div>
        @else
        <div class="h-200px rounded-top bg-{{$color}}"></div>
        @endif
        <!-- Card body START -->
        <div class="card-body py-0">
          <div class="d-sm-flex align-items-start text-center text-sm-end">
            <div>
              @if($school->schoolLogo != null)
                <div class="avatar avatar-xxl mt-n5">
                  <img class="avatar-img avatar-img rounded-circle border border-white border-3" src="{{ asset('storage/'.$school['schoolLogo']) }}">
                  <div class="input-group text-edit justify-content-center">
                    <a href="/admin/school/schoolAction/removeImage/{{$school->id}}" class="btn text-white input-group-text ps-1 border-start pt-2 pb-0">حذف</a>
                    <label class=" btn text-white input-group-text pe-1 pt-2 pb-0 " for="uploadfile-1">تعديل</label>
                  </div>
                </div>
              @else
                <div class="d-flex justify-content-center align-items-center flex-column mb-3">
                  <div class="avatar avatar-xxl mt-n5">
                    <div class="avatar-img rounded-circle border border-white border-3 bg-{{$color}}">
                      <span class="text-white position-absolute top-50 start-50 translate-middle fw-bold fs-2"> {{ mb_substr($school['school_name'], 0, 1) }} </span>
                    </div>
                    <label class="btn text-edit" for="uploadfile-1">إضافة</label>
                  </div>
                </div>
                  @endif
                <!-- Upload button -->
                <form  action="{{route('school.update',['school'=>$school->id])}}" enctype="multipart/form-data" novalidate method="POST">

                <input name="logo" id="uploadfile-1" class="form-control @error('logo') is-invalid @enderror d-none" type="file">
                @error('logo')
                <div class="invalid-feedback me-2 mb-2">
                {{$message}}
                </div>
                @enderror
              <!-- Avatar -->
            </div>
            <div class="me-sm-4 mt-sm-3">
              <!-- Info -->
              <h1 class="mb-0 h5">{{ $school->school_name }}
                @if($school->subscription >= 1)
                <i class="fa-regular fa-circle-check text-success small"> تعمل</i>
                @else
                <i class="fa-regular fa-circle-xmark text-danger small"> لا تعمل</i>
                @endif
              </h1>
              <p>@ {{$user->user_name}}</p>
            </div>
          </div>
        </div>
        <!-- Card body END -->
      </div>
      <!-- Card END -->
      <!-- Information START -->
      <div class="card">
        <!-- Card header START -->
        <div class="card-header border-0 pb-0">
          <h5 class="card-title">بيانات الملف الشخصي للمدرسة</h5>
        </div>
        <!-- Card header END -->
        <!-- Card body START -->
        <div class="card-body">
          <!-- Form settings START -->
          <div class="row g-3">
            @csrf
            @method('PUT')
            <!-- School name -->
            <div class="col-md-6">
              <label class="form-label">إسم المدرسة</label>
              <input type="text" name="school_name"  class="form-control @error('school_name') is-invalid @enderror" placeholder="الرجاء ادخال اسم المدرسة فقط" 
              value="{{$school->school_name}}">
              @error('school_name')
              <div class="invalid-feedback">
              {{$message}}
              </div>
              @enderror
            </div>
          <!-- number of instructer -->
          <div class="col-md-6">
            <label class="form-label">عدد المعلمين <span class="text-muted">(اختياري)</span></label>
            <input type="number" name="num_teachers" class="form-control" placeholder=""value="{{$school->num_of_teacher}}">
          </div>
          <!-- number of student -->
          <div class="col-md-6">
            <label class="form-label">عدد الطلاب <span class="text-muted">(اختياري)</span></label>
            <input type="number" name="num_students" class="form-control" placeholder="" value="{{$school->num_of_students}}">
          </div>
          <!-- phone number -->
          <div class="col-md-6">
            <label class="form-label">رقم الهاتف</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="ادخل رقم الهاتف بدون مفتاح الدولة" value="{{$school->phone}}">
            @error('phone')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="" value="{{$school->email}}">
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
                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="المدينة" value="{{$school->city_address}}">
                @error('city')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
              <div class="col-md-4 mt-1">
                <input type="text" name="town" id="town" class="form-control @error('town') is-invalid @enderror" placeholder="الحي" value="{{$school->town_address}}">
                @error('town')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
              <div class="col-md-4 mt-1">
                <input type="text" name="street" id="street" class="form-control @error('street') is-invalid @enderror" placeholder="الشارع" value="{{$school->street_address}}">
                @error('street')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="col-12">
            <label class="form-label">نبذة عن المدرسة <span class="text-muted">(اختياري)</span></label>
            <textarea class="form-control @error('about') is-invalid @enderror" name="about" rows="4" placeholder="تكلم عن المدرسة بإجاذ" value="">{{$school->about_school}}</textarea>
            @error('about')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md-4 mb-1">
            <label class="form-label  mb-0">نوع المؤسسة التعليمية</label>
            <div>
              <div class="form-check d-inline-block ">
                <label class="form-check-label ms-1" for="typeOne">اساس</label>
                <input id="typeOne" name="type_of" type="radio" class="form-check-input"
                @if($school->type_of == "اساس") @checked(true) @endif
                  value="اساس">
              </div>
              <div class="form-check d-inline-block me-1">
                <label class="form-check-label ms-1" for="typetow">ثانوي</label>
                <input id="typetow" name="type_of" type="radio" class="form-check-input"  value="ثانوي" 
                @if($school->type_of == "ثانوي") @checked(true)  @endif>
              </div>
            </div>
          </div>
            <button type="submit" class="btn btn-sm btn-primary fs-5 col-md-12 mt-2">تعديل</button>
        </div>
          </form>
          <!-- Settings END -->
        </div>
        <!-- Card body END -->
      </div>
      <!-- AInformation END -->
    </div>
@endsection