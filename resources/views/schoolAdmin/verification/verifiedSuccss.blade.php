@extends('layout.schoolAdminLeyout.master')
@section('titel',$titelPage)
@section('sidebarSchoolAdmin')
@endsection
@section('showHideOffcanvasNavbar','d-none')
@section('content')
<style>
    .card-confirm .img-box {
        color: #fff;
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -70px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        z-index: 9;
        padding: 5px;
        text-align: center;
        /* box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1); */
    }

    .card-confirm .img-box img {
      width:110%;
      height: 110%;
      position: relative;
        bottom: 4px;
    }
</style>
<div class="row d-flex justify-content-center align-items-center text-center vh-100">
  <!-- Offline START -->
  <div class="col-lg-3 mx-auto">
    <div class="card card-confirm  rounded-4 h-75 p-4 mt-2">
      <div class="img-box bg-white shadow">
        <img class="" src="{{asset('assets\plugins\imgs\firework.png')}}">
      </div>
      <div class="fs-4 ">
        تم التحقق من البريد  الإلكتروني
      </div>
      <div class="p-2">
        لقد تم التحقق من البريد الالكتروني بنجاح يمكن الإ تسجيل الدخول إلى المنصة
      </div>
    <a class="text-primary fw-semibold" href="/school/admin">إلى الصفحة الرئسية </a>
    </div>
  </div>
</div>
@endsection

