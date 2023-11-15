@extends('layout.schoolAdminLeyout.master')
@section('titel',$titelPage)
@section('sidebarSchoolAdmin')
@endsection
@section('showHideOffcanvasNavbar','d-none')
@section('content')

<style>
input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button{
  -webkit-appearance: none
  ;-moz-appearance: none;
  appearance: none;
  margin: 0
  }



.form-control.is-invalid, .was-validated .form-control:invalid {
  background-size: calc(0em + 0rem) calc(0em + 0rem);
}

</style>
<script src=" {{ asset('assets/js/verificationInput.js') }} "></script>
<?php
use App\Models\User;
use Illuminate\Support\Facades\Auth;
$userID = Auth::user()->id;
?>
<div class="row d-flex justify-content-center align-items-center text-center vh-100 py-5">
  <!-- Offline START -->
  <div class="col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
    <div class="card card-body rounded-3 text-center p-4 p-sm-5">
      <!-- Title -->
      <h1 class="mb-2">التحقق من البريد الإلكتروني</h1>
      <form class="mt-3" action="/school/admin/verify-account/{{$userID}}" mehtod="POST">
        @csrf
        @method('POST')
        <!-- New password -->
        <div class="mb-3">
          <div id="otp" class="d-flex flex-row justify-content-center">

            <input class="m-2 p-2 text-center form-control rounded @error('first') is-invalid @enderror" type="text" name="first" id="first" maxlength="1" >
            <input class="m-2 p-2 text-center form-control rounded @error('second') is-invalid @enderror" type="text" name="second" id="second" maxlength="1" />
            <input class="m-2 p-2 text-center form-control rounded @error('third') is-invalid @enderror" type="text" name="third" id="third" maxlength="1" />
            <input class="m-2 p-2 text-center form-control rounded @error('fourth') is-invalid @enderror" type="text" name="fourth" id="fourth" maxlength="1" />
            <input class="m-2 p-2 text-center form-control rounded @error('fifth') is-invalid @enderror" type="text" name="fifth" id="fifth" maxlength="1" />
            <input class="m-2 p-2 text-center form-control rounded @error('sixth') is-invalid @enderror" type="text" name="sixth" id="sixth" maxlength="1" />
          </div>
          <div class="d-flex mt-1">
            @if(session()->has('erorr'))
            <p class=" mb-0 small lh-sm fw-semibold text-danger">{{session()->get('erorr')}}</p>  
            @else
            <p class=" mb-0 small lh-sm fw-semibold">إبداء من هنا <i class="fa-solid fa-arrow-left text-danger"></i> إدخال الرمز التي تم إرسالها اليك في البريد الإلكتروني هنا</p>            
            @endif
            <div class="me-auto">
              <span class="d-inline-block" tabindex="0" data-bs-placement="top" data-bs-container="body" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="إذا لم يتم إرسال رسالة التحقق إلى البريد الإلكتروني , قم بالتأكد من البريد الإلكتروني المرتبط بالحساب و المحاولة مرة أخرى ">
                <i class="fa-solid fa-circle-info cursor-pointer pe-1"></i>
              </span>
            </div>
          </div>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-lg btn-primary rounded-1">تحقق</button>
        </div>
        <div class="mt-3">

          @if(session()->has('erorr1'))
          <p class=" mb-0 small lh-sm fw-semibold text-danger">{{session()->get('erorr1')}}</p>  
          @endif
          @if(session()->has('success1'))
          <p class=" mb-0 small lh-sm fw-semibold text-primary">{{session()->get('success1')}}</p>  
          @endif
          <p class=""><div class="fw-semibold d-inline">لم أتحصل على الرمز </div>
            <a href="/school/admin/resendEmailVerification{{$userID}}" class="text-primary fw-semibold">إرسال الرمز مرة اخرى (@if(session()->exists('try')) {{session()->get('try')}} @else 0 @endif /3)</a>
          </p>
        </div>
        <p class="mb-0 mt-3">©2023 <a target="_blank" href="#">Hashcode</a> All rights
          reserved</p>
      </form>
    </div>
  </div>
  <!-- Offline START -->
</div>
@endsection



