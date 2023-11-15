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
      @if(session()->has('success'))
        <div class="alert alert-primary alert-dismissible show" role="alert">
          {{session()->get('success')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if(session()->has('danger'))      
        <div class="alert alert-danger alert-dismissible show" role="alert">
          {{session()->get('danger')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <div class="card-body">
        <form class="row g-3 form" id="form" action="{{route('teatcher.store')}}" method="post" enctype="multipart/form-data" novalidate>
          @csrf
          <div class="col-md-6">
            <label class="form-label">اسم المادة</label>
            <input type="text" name="subjectName"  class="form-control @error('subjectName') is-invalid @enderror" placeholder="الرجاء ادخال إسم المادة الدراسية " 
            value="{{old('subjectName')}}">
            @error('subjectName')
            <div class="invalid-feedback">
            {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">المستوى التعليمي</label>
            <select class="form-control form-select @error('lavel') is-invalid @enderror" name="lavel">
              @for()
              <option value="">المستوى الاول</option>
              <option value="">المستوى الثاني</option>
              <option value="">المستوى الثالث</option>
            </select>
            @error('lavel')
            <div class="invalid-feedback">
            {{$message}}
            </div>
            @enderror
          </div>
          <!-- Button  -->
          <div class="col-md text-center">
            <button type="submit" class="btn btn-sm btn-primary fs-5 col-md-12 mt-2">إنشاء</button>
          </div>
        </form>
        <!-- Settings END -->
      </div>
      <!-- Card body END -->
    </div>
  </div>
@endsection