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
HOME
</div>
@endsection